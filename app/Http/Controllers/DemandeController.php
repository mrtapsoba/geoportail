<?php

namespace App\Http\Controllers;

use App\Models\Demande;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DemandeController extends Controller
{
    //
    public function index()
    {

        $myId = auth()->id();
        $user = User::find($myId);
        if ($user->account_type == "client") {
            return $this->indexClient();
        }
        $data = Demande::all();
        for ($i = 0; $i < count($data); $i++) {
            $user = User::find($data[$i]->user_id);
            $data[$i]->auteur = $user->prenom . " " . $user->nom;
        }
        $nbAtt = Demande::where('etat', 'En attente')->count();
        $nbEtude = Demande::where('etat', 'En etude')->count();
        $nbPriseEnCompte = Demande::where('etat', 'Prise en compte')->count();
        $nbRejete = Demande::where('etat', 'Rejetee')->count();
        return view('demande', ["demandes" => $data, "nbAttente" => $nbAtt, "nbEtude" => $nbEtude, "nbPriseEnCompte" => $nbPriseEnCompte, "nbRejete" => $nbRejete]);
    }

    public function details($id)
    {

        $myId = auth()->id();
        $user = User::find($myId);
        if ($user->account_type == "client") {
            return $this->detailsClient($id);
        }
        $data = Demande::find($id);
        $user = User::find($data->user_id);
        $data->auteur =  $user->prenom . " " . $user->nom;
        //$data->reponses = $data->reponses;
        //dd($reponses);
        $nbAtt = Demande::where('etat', 'En attente')->count();
        $nbEtude = Demande::where('etat', 'En etude')->count();
        $nbPriseEnCompte = Demande::where('etat', 'Prise en compte')->count();
        $nbRejete = Demande::where('etat', 'Rejetee')->count();
        return view('demandeDetails', ["details" => $data, "nbAttente" => $nbAtt, "nbEtude" => $nbEtude, "nbPriseEnCompte" => $nbPriseEnCompte, "nbRejete" => $nbRejete]);
    }

    public function  postDemande(Request $request)
    {
        //dd($request);
        $request->validate([
            'email' => 'required',
            'objet' => 'required',
            'mot_cle' => 'required',
            'fiche_demande' => 'required',
            'justificatifs' => 'required',

        ]);
        $user = User::find(auth()->id());

        if ($request->hasFile('fiche_demande') && $request->hasFile('justificatifs')) {

            $fiche_demande = $request->file('fiche_demande');
            $file1 = time() . $fiche_demande->getClientOriginalName();
            $justificatifs = $request->file('justificatifs');
            $file2 = time() . $justificatifs->getClientOriginalName();

            $path = $request->file('fiche_demande')->move(public_path('demandes/fiches'), $file1);
            $path = $request->file('justificatifs')->move(public_path('demandes/justificatifs'), $file2);
        }


        $user->demandes()->create([
            'email' => $request->email,
            'objet' => $request->objet,
            'etat' => 'En attente',
            'mot_cle' => $request->mot_cle,
            'fiche_demande' => 'fiches/' . $file1,
            'justificatifs' => 'justificatifs/' . $file2,
        ]);

        //dd($filename);
        return back()->with('message', 'Votre demande a ete ajoute. Vous serez repondu dans les plus brefs delai');
    }
    public function postDemandeReponse(Request $request)
    {
        //dd($request);
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'etat' => 'required',
            'reponse' => 'required|min:5',

        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)
                ->withInput();
        }

        //dd($validator);
        $validated = $validator->validated();


        $user = User::find(auth()->id());
        $demande = Demande::find($validated['id']);
        if ($user->account_type == 'Producteur') {
            $demande->reponses()->create([
                'user_id' => $user->id,
                'etat' => $validated['etat'],
                'response' => $validated['reponse'],
            ]);
            $etat = 'En attente';
            if ($validated['etat'] == 1) {
                $etat = 'En attente';
            } else if ($validated['etat'] == 2) {
                $etat = 'En etude';
            } else if ($validated['etat'] == 3) {
                $etat = 'Prise en compte';
            } else if ($validated['etat'] == 4) {
                $etat = 'Rejetee';
            }
            $demande->update([
                'etat' => $etat,
            ]);

            return redirect('compte/demande/details/' . $validated['id'])
                ->with([
                    'message' => 'Votre reponse a ete envoyee',
                    'status' => 0
                ]);
        } else {
            return redirect('/');
        }
    }
    public function postDemandeReponse2(Request $request)
    {
        //dd($request);
        $validator = $request->validate([
            'id' => 'required',
            'etat' => 'required',
            'reponse' => 'required|min:255',

        ]);

        dd($request);


        $user = User::find(auth()->id());
        $demande = Demande::find($request->id);
        if ($user->account_type == 'Producteur') {
            $demande->reponses()->create([
                'user_id' => $user->id,
                'etat' => $request->etat,
                'response' => $request->response,
            ]);
            return redirect('compte/demande/details/' . $request->id)
                ->with([
                    'message' => 'Votre reponse a ete envoyee',
                    'status' => 0
                ]);
        } else {
            return redirect('/');
        }
    }

    public function indexClient()
    {
        $myId = auth()->id();
        $user = User::find($myId);
        if ($user->account_type == "client") {
            $data = Demande::where('user_id', $myId)->get();


            $nbAtt = Demande::where(['etat' => 'En attente', 'user_id' => $myId])->count();
            $nbEtude = Demande::where(['etat' => 'En etude', 'user_id' => $myId])->count();
            $nbPriseEnCompte = Demande::where(['etat' => 'Prise en compte', 'user_id' => $myId])->count();
            $nbRejete = Demande::where(['etat' => 'Rejetee', 'user_id' => $myId])->count();
            return view('client.demande', ["demandes" => $data, "nbAttente" => $nbAtt, "nbEtude" => $nbEtude, "nbPriseEnCompte" => $nbPriseEnCompte, "nbRejete" => $nbRejete]);
        } else {
            return redirect('compte');
        }
    }

    public function detailsClient($id)
    {

        $myId = auth()->id();
        $user = User::find($myId);
        if ($user->account_type == "client") {
            $data = Demande::where(['id' => $id, 'user_id' => $myId])->first();

            $nbAtt = Demande::where(['etat' => 'En attente', 'user_id' => $myId])->count();
            $nbEtude = Demande::where(['etat' => 'En etude', 'user_id' => $myId])->count();
            $nbPriseEnCompte = Demande::where(['etat' => 'Prise en compte', 'user_id' => $myId])->count();
            $nbRejete = Demande::where(['etat' => 'Rejetee', 'user_id' => $myId])->count();
            return view('client.demandeDetails', ["details" => $data, "nbAttente" => $nbAtt, "nbEtude" => $nbEtude, "nbPriseEnCompte" => $nbPriseEnCompte, "nbRejete" => $nbRejete]);
        } else {
            return redirect('compte');
        }
    }

    public function  postDemandeClient(Request $request)
    {
        //dd($request);
        $request->validate([
            'email' => 'required',
            'objet' => 'required',
            'mot_cle' => 'required',
            'fiche_demande' => 'required',
            'justificatifs' => 'required',

        ]);
        $user = User::find(auth()->id());

        if ($request->hasFile('fiche_demande') && $request->hasFile('justificatifs')) {

            $fiche_demande = $request->file('fiche_demande');
            $file1 = time() . $fiche_demande->getClientOriginalName();
            $justificatifs = $request->file('justificatifs');
            $file2 = time() . $justificatifs->getClientOriginalName();

            $path = $request->file('fiche_demande')->move(public_path('demandes/fiches'), $file1);
            $path = $request->file('justificatifs')->move(public_path('demandes/justificatifs'), $file2);
        }


        $user->demandes()->create([
            'email' => $request->email,
            'objet' => $request->objet,
            'etat' => 'En attente',
            'mot_cle' => $request->mot_cle,
            'fiche_demande' => 'fiches/' . $file1,
            'justificatifs' => 'justificatifs/' . $file2,
        ]);

        //dd($filename);
        return back()->with('message', 'Votre demande a ete ajoute. Vous serez repondu dans les plus brefs delai');
    }
}
