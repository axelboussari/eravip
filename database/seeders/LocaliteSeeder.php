<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\departements as Departement;
use App\Models\communes as Commune;
use App\Models\arrondissements as Arrondissement;
use App\Models\quartiers as Quartier;
use Illuminate\Support\Str;

class LocaliteSeeder extends Seeder
{
    /**
     * Exécuter le seeder.
     */
    public function run(): void
    {
        $this->command->info('Début du seed des localités du Bénin...');
        
        // 1. Créer les départements
        $this->createDepartements();
        
        // 2. Créer les communes
        $this->createCommunes();
        
        // 3. Créer les arrondissements
        $this->createArrondissements();
        
        // 4. Créer les quartiers
        $this->createQuartiers();
        
        $this->command->info('Seed des localités terminé avec succès!');
    }
    
    /**
     * Créer les départements du Bénin.
     */
    private function createDepartements(): void
    {
        $departements = [
            ['nom_departement' => 'Littoral'],
            ['nom_departement' => 'Atlantique'],
            ['nom_departement' => 'Ouémé'],
            ['nom_departement' => 'Plateau'],
            ['nom_departement' => 'Zou'],
            ['nom_departement' => 'Collines'],
            ['nom_departement' => 'Borgou'],
            ['nom_departement' => 'Alibori'],
            ['nom_departement' => 'Atacora'],
            ['nom_departement' => 'Donga'],
            ['nom_departement' => 'Mono'],
            ['nom_departement' => 'Couffo'],
        ];
        
        foreach ($departements as $departement) {
            Departement::create($departement);
        }
        
        $this->command->info(count($departements) . ' départements créés.');
    }
    
    /**
     * Créer les communes du Bénin.
     */
    private function createCommunes(): void
    {
        $departements = Departement::all()->keyBy('nom_departement');
        
        $communes = [
            // Littoral
            ['nom_commune' => 'Cotonou', 'departement' => 'Littoral'],
            
            // Atlantique
            ['nom_commune' => 'Abomey-Calavi', 'departement' => 'Atlantique'],
            ['nom_commune' => 'Allada', 'departement' => 'Atlantique'],
            ['nom_commune' => 'Kpomassè', 'departement' => 'Atlantique'],
            ['nom_commune' => 'Ouidah', 'departement' => 'Atlantique'],
            ['nom_commune' => 'Sô-Ava', 'departement' => 'Atlantique'],
            ['nom_commune' => 'Toffo', 'departement' => 'Atlantique'],
            ['nom_commune' => 'Tori-Bossito', 'departement' => 'Atlantique'],
            ['nom_commune' => 'Zè', 'departement' => 'Atlantique'],
            
            // Ouémé
            ['nom_commune' => 'Porto-Novo', 'departement' => 'Ouémé'],
            ['nom_commune' => 'Adjarra', 'departement' => 'Ouémé'],
            ['nom_commune' => 'Adjohoun', 'departement' => 'Ouémé'],
            ['nom_commune' => 'Aguégués', 'departement' => 'Ouémé'],
            ['nom_commune' => 'Akpro-Missérété', 'departement' => 'Ouémé'],
            ['nom_commune' => 'Avrankou', 'departement' => 'Ouémé'],
            ['nom_commune' => 'Bonou', 'departement' => 'Ouémé'],
            ['nom_commune' => 'Dangbo', 'departement' => 'Ouémé'],
            ['nom_commune' => 'Sèmè-Kpodji', 'departement' => 'Ouémé'],
            
            // Plateau
            ['nom_commune' => 'Ifangni', 'departement' => 'Plateau'],
            ['nom_commune' => 'Adja-Ouèrè', 'departement' => 'Plateau'],
            ['nom_commune' => 'Kétou', 'departement' => 'Plateau'],
            ['nom_commune' => 'Pobè', 'departement' => 'Plateau'],
            ['nom_commune' => 'Sakété', 'departement' => 'Plateau'],
            
            // Zou
            ['nom_commune' => 'Abomey', 'departement' => 'Zou'],
            ['nom_commune' => 'Agbangnizoun', 'departement' => 'Zou'],
            ['nom_commune' => 'Bohicon', 'departement' => 'Zou'],
            ['nom_commune' => 'Covè', 'departement' => 'Zou'],
            ['nom_commune' => 'Djidja', 'departement' => 'Zou'],
            ['nom_commune' => 'Ouinhi', 'departement' => 'Zou'],
            ['nom_commune' => 'Za-Kpota', 'departement' => 'Zou'],
            ['nom_commune' => 'Zagnanado', 'departement' => 'Zou'],
            ['nom_commune' => 'Zoogbodomey', 'departement' => 'Zou'],
            
            // Collines
            ['nom_commune' => 'Bantè', 'departement' => 'Collines'],
            ['nom_commune' => 'Dassa-Zoumè', 'departement' => 'Collines'],
            ['nom_commune' => 'Glazoué', 'departement' => 'Collines'],
            ['nom_commune' => 'Ouèssè', 'departement' => 'Collines'],
            ['nom_commune' => 'Savalou', 'departement' => 'Collines'],
            ['nom_commune' => 'Savè', 'departement' => 'Collines'],
            
            // Borgou
            ['nom_commune' => 'Bembèrèkè', 'departement' => 'Borgou'],
            ['nom_commune' => 'Kalalé', 'departement' => 'Borgou'],
            ['nom_commune' => 'N\'Dali', 'departement' => 'Borgou'],
            ['nom_commune' => 'Nikki', 'departement' => 'Borgou'],
            ['nom_commune' => 'Parakou', 'departement' => 'Borgou'],
            ['nom_commune' => 'Pèrèrè', 'departement' => 'Borgou'],
            ['nom_commune' => 'Sinendé', 'departement' => 'Borgou'],
            ['nom_commune' => 'Tchaourou', 'departement' => 'Borgou'],
            
            // Alibori
            ['nom_commune' => 'Banikoara', 'departement' => 'Alibori'],
            ['nom_commune' => 'Gogounou', 'departement' => 'Alibori'],
            ['nom_commune' => 'Kandi', 'departement' => 'Alibori'],
            ['nom_commune' => 'Karimama', 'departement' => 'Alibori'],
            ['nom_commune' => 'Malanville', 'departement' => 'Alibori'],
            ['nom_commune' => 'Ségbana', 'departement' => 'Alibori'],
            
            // Atacora
            ['nom_commune' => 'Boukoumbé', 'departement' => 'Atacora'],
            ['nom_commune' => 'Cobly', 'departement' => 'Atacora'],
            ['nom_commune' => 'Kérou', 'departement' => 'Atacora'],
            ['nom_commune' => 'Kouandé', 'departement' => 'Atacora'],
            ['nom_commune' => 'Matéri', 'departement' => 'Atacora'],
            ['nom_commune' => 'Natitingou', 'departement' => 'Atacora'],
            ['nom_commune' => 'Pehonko', 'departement' => 'Atacora'],
            ['nom_commune' => 'Tanguiéta', 'departement' => 'Atacora'],
            ['nom_commune' => 'Toucountouna', 'departement' => 'Atacora'],
            
            // Donga
            ['nom_commune' => 'Bassila', 'departement' => 'Donga'],
            ['nom_commune' => 'Copargo', 'departement' => 'Donga'],
            ['nom_commune' => 'Djougou', 'departement' => 'Donga'],
            ['nom_commune' => 'Ouaké', 'departement' => 'Donga'],
            
            // Mono
            ['nom_commune' => 'Athiémè', 'departement' => 'Mono'],
            ['nom_commune' => 'Bopa', 'departement' => 'Mono'],
            ['nom_commune' => 'Comè', 'departement' => 'Mono'],
            ['nom_commune' => 'Grand-Popo', 'departement' => 'Mono'],
            ['nom_commune' => 'Houéyogbé', 'departement' => 'Mono'],
            ['nom_commune' => 'Lokossa', 'departement' => 'Mono'],
            
            // Couffo
            ['nom_commune' => 'Aplahoué', 'departement' => 'Couffo'],
            ['nom_commune' => 'Djakotomey', 'departement' => 'Couffo'],
            ['nom_commune' => 'Dogbo', 'departement' => 'Couffo'],
            ['nom_commune' => 'Klouékanmè', 'departement' => 'Couffo'],
            ['nom_commune' => 'Lalo', 'departement' => 'Couffo'],
            ['nom_commune' => 'Toviklin', 'departement' => 'Couffo'],
        ];
        
        foreach ($communes as $communeData) {
           $departement = $departements->get($communeData['departement']);
            
            if ($departement) {
                Commune::create([
                    'id' => Str::uuid(),
                    'nom_commune' => $communeData['nom_commune'],
                    'departement_id' => $departement->id,
                ]);
            }
        }
        
        $this->command->info(count($communes) . ' communes créées.');
    }
    
    /**
     * Créer les arrondissements.
     */
    private function createArrondissements(): void
    {
        $communes = Commune::all()->keyBy('nom_commune');
        $arrondissements = [];
        
        // Arrondissements de Cotonou
        if ($cotonou = $communes['Cotonou'] ?? null) {
            for ($i = 1; $i <= 6; $i++) {
                $arrondissements[] = [
                    'commune' => 'Cotonou',
                    'nom_arrondissement' => $i . ($i == 1 ? 'er' : 'e') . ' Arrondissement',
                ];
            }
        }
        
        // Arrondissements de Porto-Novo
        if ($portoNovo = $communes['Porto-Novo'] ?? null) {
            for ($i = 1; $i <= 5; $i++) {
                $arrondissements[] = [
                    'commune' => 'Porto-Novo',
                    'nom_arrondissement' => $i . ($i == 1 ? 'er' : 'e') . ' Arrondissement',
                ];
            }
        }
        
        // Arrondissements d'Abomey-Calavi
        if ($abomeyCalavi = $communes['Abomey-Calavi'] ?? null) {
            for ($i = 1; $i <= 4; $i++) {
                $arrondissements[] = [
                    'commune' => 'Abomey-Calavi',
                    'nom_arrondissement' => $i . ($i == 1 ? 'er' : 'e') . ' Arrondissement',
                ];
            }
        }
        
        // Arrondissements d'Ouidah
        if ($ouidah = $communes['Ouidah'] ?? null) {
            for ($i = 1; $i <= 3; $i++) {
                $arrondissements[] = [
                    'commune' => 'Ouidah',
                    'nom_arrondissement' => $i . ($i == 1 ? 'er' : 'e') . ' Arrondissement',
                ];
            }
        }
        
        // Arrondissements de Parakou
        if ($parakou = $communes['Parakou'] ?? null) {
            for ($i = 1; $i <= 3; $i++) {
                $arrondissements[] = [
                    'commune' => 'Parakou',
                    'nom_arrondissement' => $i . ($i == 1 ? 'er' : 'e') . ' Arrondissement',
                ];
            }
        }
        
        // Arrondissements de Djougou
        if ($djougou = $communes['Djougou'] ?? null) {
            for ($i = 1; $i <= 3; $i++) {
                $arrondissements[] = [
                    'commune' => 'Djougou',
                    'nom_arrondissement' => $i . ($i == 1 ? 'er' : 'e') . ' Arrondissement',
                ];
            }
        }
        
        // Arrondissements génériques pour les autres communes
        $autresCommunes = $communes->except(['Cotonou', 'Porto-Novo', 'Abomey-Calavi', 'Ouidah', 'Parakou', 'Djougou']);
        
        foreach ($autresCommunes as $commune) {
            $arrondissements[] = [
                'commune' => $commune->nom_commune,
                'nom_arrondissement' => 'Arrondissement Central',
            ];
        }
        
        // Créer les arrondissements
        foreach ($arrondissements as $arrData) {
            $commune = $communes[$arrData['commune']] ?? null;
            
            if ($commune) {
                Arrondissement::create([
                    'id' => Str::uuid(),
                    'nom_arrondissement' => $arrData['nom_arrondissement'],
                    'commune_id' => $commune->id,
                ]);
            }
        }
        
        $this->command->info(count($arrondissements) . ' arrondissements créés.');
    }
    
    /**
     * Créer les quartiers.
     */
    private function createQuartiers(): void
    {
        $arrondissements = Arrondissement::with('commune')->get();
        $quartiersCrees = 0;
        
        // Liste de noms de quartiers courants au Bénin
        $nomsQuartiers = [
            'Ahouansori', 'Akpakpa', 'Cadjehoun', 'Agla', 'Ganhi', 'Godomey',
            'Hêvié', 'Missessin', 'Zogbo', 'Calavi', 'Togba', 'Abomey-Calavi Centre',
            'Porto-Novo Centre', 'Avakpa', 'Agbokou', 'Djègbadji', 'Pahou', 'Ouando',
            'Savalou Centre', 'Parakou Centre', 'Tchaourou Centre', 'Natitingou Centre',
            'Djougou Centre', 'Lokossa Centre', 'Bohicon Centre', 'Abomey Centre',
            'Kandi Centre', 'Malanville Centre', 'Sakété Centre', 'Pobè Centre',
            'Kétou Centre', 'Ouidah Centre', 'Allada Centre', 'Bopa Centre',
            'Comè Centre', 'Grand-Popo Centre', 'Aplahoué Centre', 'Dogbo Centre'
        ];
        
        foreach ($arrondissements as $arrondissement) {
            // Créer 3 à 6 quartiers par arrondissement
            $nbQuartiers = rand(3, 6);
            
            for ($i = 1; $i <= $nbQuartiers; $i++) {
                $nomQuartier = $nomsQuartiers[array_rand($nomsQuartiers)];
                
                // Ajouter un numéro ou un suffixe pour éviter les doublons dans le même arrondissement
                if ($i > 1) {
                    $nomQuartier .= ' ' . $this->getSuffixe($i);
                }
                
                Quartier::create([
                    'id' => Str::uuid(),
                    'nom_quartier' => $nomQuartier,
                    'arrondissement_id' => $arrondissement->id,
                ]);
                
                $quartiersCrees++;
            }
        }
        
        $this->command->info($quartiersCrees . ' quartiers créés.');
    }
    
    /**
     * Obtenir un suffixe pour les noms de quartiers.
     */
    private function getSuffixe(int $numero): string
    {
        $suffixes = [
            1 => 'Nord',
            2 => 'Sud',
            3 => 'Est',
            4 => 'Ouest',
            5 => 'Centre',
            6 => 'Extension',
        ];
        
        return $suffixes[$numero] ?? 'Secteur ' . $numero;
    }
}