<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hebergement;
use App\Models\ReservationsHebergement;
use Illuminate\Support\Facades\Auth;
use Stripe\Stripe;
use Stripe\Charge;
use Stripe\PaymentIntent;
class ReservationsHebergementController extends Controller
{
    public function store(Request $request)
    {
        // Validation des données du formulaire
        $validated = $request->validate([
            'hebergement_id' => 'required|exists:hebergements,id',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after:start_date',
            'guests' => 'required|integer|min:1',
            'special_requests' => 'nullable|string',
        ]);

        // Calcul du prix total
        $hebergement = Hebergement::findOrFail($request->hebergement_id);
        $startDate = new \DateTime($request->start_date);
        $endDate = new \DateTime($request->end_date);
        $days = $startDate->diff($endDate)->days;
        $totalPrice = $days * $hebergement->price_per_night * $request->guests;

        // Création de la réservation
        try {
            $reservation = ReservationsHebergement::create([
                'hebergement_id' => $request->hebergement_id,
                'user_id' => Auth::id(),
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'guests' => $request->guests,
                'total_price' => $totalPrice,
                'status' => 'en attente',
                'special_requests' => $request->special_requests,
            ]);
        } catch (\Exception $e) {
            return back()->with('error', 'Erreur lors de la création de la réservation : ' . $e->getMessage());
        }

        // Redirection avec message de succès
        return redirect()->route('hebergement.UI_index', $request->hebergement_id)
            ->with('success', 'Réservation effectuée avec succès. Votre réservation est en attente de confirmation.');
    }
    public function index()
    {
        // Récupérer les réservations de l'utilisateur connecté
        $reservations = ReservationsHebergement::where('user_id', Auth::id())
            ->with('hebergement')
            ->orderBy('start_date', 'desc')
            ->get();
        
        return view('pages.Reservation.index', compact('reservations'));
    }

    public function showPaymentForm($reservationId)
    {
        $reservation = ReservationsHebergement::findOrFail($reservationId);
        return view('pages.Reservation.pay', compact('reservation'));
    }

    public function createPaymentIntent($reservationId)
    {
        $reservation = ReservationsHebergement::findOrFail($reservationId);
        Stripe::setApiKey(config('services.stripe.secret'));

        try {
            $paymentIntent = PaymentIntent::create([
                'amount' => $reservation->total_price * 100,
                'currency' => 'eur',
                'description' => 'Paiement de la réservation #' . $reservation->id,
            ]);
            $reservation->status = 'confirmée';
            $reservation->save(); 
            return response()->json(['client_secret' => $paymentIntent->client_secret]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function show($id)
    {
        // Récupérer la réservation avec les informations de l'hébergement
        $reservation = ReservationsHebergement::with('hebergement')->findOrFail($id);

        // Retourner la vue avec les données de la réservation
        return view('pages.Reservation.details', compact('reservation'));
    }

  
    public function delete($id)
    {
        $reservation = ReservationsHebergement::findOrFail($id);

        // Vérifier si la réservation est en attente avant de la supprimer
        if ($reservation->status == 'en attente') {
            $reservation->delete();
            return redirect()->route('reservations.index')->with('success', 'La réservation a été annulée avec succès.');
        }

        return redirect()->route('reservations.index')->with('error', 'Seules les réservations en attente peuvent être annulées.');
    }

    public function index_BackOffice()
    {
        $reservations = ReservationsHebergement::with(['hebergement', 'user'])->get();
        $totalReservations = ReservationsHebergement::totalReservations();
        $reservationsByStatus = ReservationsHebergement::reservationsByStatus();
        $totalRevenue = ReservationsHebergement::totalRevenue();
        $monthlyReservations = ReservationsHebergement::monthlyReservations();

        return view('pages.Reservation.Index_BackOffice', compact('reservations', 'totalReservations', 'reservationsByStatus', 'totalRevenue', 'monthlyReservations'));
    }

}


