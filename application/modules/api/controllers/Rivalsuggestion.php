<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
require_once(APPPATH.'modules/api/controllers/Rest.php');

class Rivalsuggestion extends Rest {
    public function __construct() {
        parent::__construct();
        $this->load->model('rating_model');
        $this->load->model('team_model');
        $this->cekToken();
    }
    
    public function index_get(){
    	$userId = $this->getUserIdFromToken();
    	$teamId = $this->team_model->getTeamIdFrom($userId);

    	//BOBOT
    	$bobot = [
    		"sportsmanship"	=> $this->get("sportsmanship"),
    		"teamwork"	=> $this->get("teamwork"),
    		"ability"	=>$this->get("ability"),
    		"dayatahan"	=> $this->get("dayatahan"),
    		"strategi"	=> $this->get("strategi"),
    		"keterampilan"	=> $this->get("keterampilan"),
    		"kecepatan"		=> $this->get("kecepatan"),
    	];

    	//matrik
    	$matriknilai = [];

    	// ambil data 
    	// $team = $this->team_model->getAllWithoutTeamId($teamId);
    	$team = $this->team_model->getAll();
    	foreach ($team as $key => $value) {
    		$nilai = $this->rating_model->getDataAvg($value->id);
    		$matriknilai[] = [
    			"team_id"	=> $value->id,
    			"team_name"	=> $value->name,
    			"sportsmanship" => (double)$nilai['sportsmanship'],
    			"teamwork" => (double)$nilai['teamwork'],
    			"ability" => (double)$nilai['ability'],
    			"dayatahan" => (double)$nilai['dayatahan'],
    			"strategi" => (double)$nilai['strategi'],
    			"keterampilan" => (double)$nilai['keterampilan'],
    			"kecepatan" => (double)$nilai['kecepatan'],
    		];	
    	}

    	// $this->response($matriknilai);

    	// normalisasi

    	$matriknilai_normalisasi = [];
    	foreach ($matriknilai as $key => $value) {
    		$matriknilai_normalisasi[] = [
    			"team_id"	=> $value['team_id'],
    			"team_name"	=> $value['team_name'],

    			"sportsmanship" => pow($value['sportsmanship'],2),
    			"teamwork" => pow($value['teamwork'],2),
    			"ability" => pow($value['ability'],2),
    			"dayatahan" => pow($value['dayatahan'],2),
    			"strategi" => pow($value['strategi'],2),
    			"keterampilan" => pow($value['keterampilan'],2),
    			"kecepatan" => pow($value['kecepatan'],2),
    		];
    	}
    	// $this->response($matriknilai_normalisasi);

    	// total normalisasi
    	$totalmatriknilai_normalisasi = [
    		"sportsmanship"	=> 0,
    		"teamwork"		=> 0,
    		"ability"		=> 0,
    		"dayatahan"		=> 0,
    		"strategi"		=> 0,
    		"keterampilan"	=> 0,
    		"kecepatan"		=> 0,
    	];
    	foreach ($matriknilai_normalisasi as $key => $value) {
    		$totalmatriknilai_normalisasi["sportsmanship"] += $value["sportsmanship"];
    		$totalmatriknilai_normalisasi["teamwork"] += $value["teamwork"];
    		$totalmatriknilai_normalisasi["ability"] += $value["ability"];
    		$totalmatriknilai_normalisasi["dayatahan"] += $value["dayatahan"];
    		$totalmatriknilai_normalisasi["strategi"] += $value["strategi"];
    		$totalmatriknilai_normalisasi["keterampilan"] += $value["keterampilan"];
    		$totalmatriknilai_normalisasi["kecepatan"] += $value["kecepatan"];
    	}
    	// $this->response($totalmatriknilai_normalisasi);

    	// normalisasi pembagian
    	$matriknilai_normalisasi_pembagian = [];
    	foreach ($matriknilai as $key => $value) {
    		$matriknilai_normalisasi_pembagian[] = [
    			"team_id"	=> $value['team_id'],
    			"team_name"	=> $value['team_name'],

    			"sportsmanship"	=> $value["sportsmanship"] / sqrt($totalmatriknilai_normalisasi['sportsmanship']),
    			"teamwork"	=> $value["teamwork"] / sqrt($totalmatriknilai_normalisasi['teamwork']),
    			"ability"	=> $value["ability"] / sqrt($totalmatriknilai_normalisasi['ability']),
    			"dayatahan"	=> $value["dayatahan"] / sqrt($totalmatriknilai_normalisasi['dayatahan']),
    			"strategi"	=> $value["strategi"] / sqrt($totalmatriknilai_normalisasi['strategi']),
    			"keterampilan"	=> $value["keterampilan"] / sqrt($totalmatriknilai_normalisasi['keterampilan']),
    			"kecepatan"	=> $value["kecepatan"] / sqrt($totalmatriknilai_normalisasi['kecepatan']),
    		];
    	}
    	// $this->response($matriknilai_normalisasi_pembagian);


    	//normalisasi terbobot
    	$matriknilai_normalisasi_terbobot = []; 
    	foreach ($matriknilai_normalisasi_pembagian as $key => $value) {
    		$matriknilai_normalisasi_terbobot[]	= [
    			"team_id"	=> $value['team_id'],
    			"team_name"	=> $value['team_name'],

    			"sportsmanship"	=> $value["sportsmanship"] * $bobot["sportsmanship"],
    			"teamwork"	=> $value["teamwork"] * $bobot["teamwork"],
    			"ability"	=> $value["ability"] * $bobot["ability"],
    			"dayatahan"	=> $value["dayatahan"] * $bobot["dayatahan"],
    			"strategi"	=> $value["strategi"] * $bobot["strategi"],
    			"keterampilan"	=> $value["keterampilan"] * $bobot["keterampilan"],
    			"kecepatan"	=> $value["kecepatan"] * $bobot["kecepatan"],
    		];
    	}
    	// $this->response($matriknilai_normalisasi_terbobot);

    	// pencarian MAX & MIN
    	// nilai normalisasi terbobot (kriteria) di simpan di masing masing variable untuk mempermudah pencarian nilai MAX & MIN
    	$tempSportmanship = []; $tempTeamwork = []; $tempDayatahan = []; $tempStrategi = []; $tempKeterampilan = []; $tempKecepatan = [];

    	foreach ($matriknilai_normalisasi_terbobot as $key => $value) {
    		$tempSportmanship[] = $value["sportsmanship"];
    		$tempTeamwork[] = $value["teamwork"];
    		$tempAbility[] = $value["ability"];
    		$tempDayatahan[] = $value["dayatahan"];
    		$tempStrategi[] = $value["strategi"];
    		$tempKeterampilan[] = $value["keterampilan"];
    		$tempKecepatan[] = $value["kecepatan"];
    	}

    	$max = [
    		"sportsmanship"	=> max($tempSportmanship),
    		"teamwork"		=> max($tempTeamwork),
    		"ability"		=> max($tempAbility),
    		"dayatahan"		=> max($tempDayatahan),
    		"strategi"		=> max($tempStrategi),
			"keterampilan"	=> max($tempKeterampilan),
    		"kecepatan"		=> max($tempKecepatan),
    	];

		$min = [
    		"sportsmanship"	=> min($tempSportmanship),
    		"teamwork"		=> min($tempTeamwork),
    		"ability"		=> min($tempAbility),
    		"dayatahan"		=> min($tempDayatahan),
    		"strategi"		=> min($tempStrategi),
			"keterampilan"	=> min($tempKeterampilan),
    		"kecepatan"		=> min($tempKecepatan),
    	];	
    	// $this->response($max);
    	// $this->response($min);


    	// MATRIK SOLUSI IDEAL
    	$atribut = ["Benefit","Benefit","Benefit","Benefit","Benefit","Benefit","Benefit"];

    	$matriksolusi_ideal = [];
    	$matriksolusi_ideal["positif"] = [
    		"sportsmanship"	=> $atribut[0] == "Benefit" ? $max["sportsmanship"] : $min["sportsmanship"],
    		"teamwork"		=> $atribut[1] == "Benefit" ? $max["teamwork"] : $min["teamwork"],
    		"ability"		=> $atribut[2] == "Benefit" ? $max["ability"] : $min["ability"],
    		"dayatahan"		=> $atribut[3] == "Benefit" ? $max["dayatahan"] : $min["dayatahan"],
    		"strategi"		=> $atribut[4] == "Benefit" ? $max["strategi"] : $min["strategi"],
			"keterampilan"	=> $atribut[5] == "Benefit" ? $max["keterampilan"] : $min["keterampilan"],
    		"kecepatan"		=> $atribut[6] == "Benefit" ? $max["kecepatan"] : $min["kecepatan"],
    	];

    	$matriksolusi_ideal["negatif"] = [
    		"sportsmanship"	=> $atribut[0] == "Benefit" ? $min["sportsmanship"] : $max["sportsmanship"],
    		"teamwork"		=> $atribut[1] == "Benefit" ? $min["teamwork"] : $max["teamwork"],
    		"ability"		=> $atribut[2] == "Benefit" ? $min["ability"] : $max["ability"],
    		"dayatahan"		=> $atribut[3] == "Benefit" ? $min["dayatahan"] : $max["dayatahan"],
    		"strategi"		=> $atribut[4] == "Benefit" ? $min["strategi"] : $max["strategi"],
			"keterampilan"	=> $atribut[5] == "Benefit" ? $min["keterampilan"] : $max["keterampilan"],
    		"kecepatan"		=> $atribut[6] == "Benefit" ? $min["kecepatan"] : $max["kecepatan"],
    	];
    	// $this->response($matriksolusi_ideal);

    	// JARAK SOLUSI POSITIF
    	$solusi_positif = [];

    	foreach ($matriknilai_normalisasi_terbobot as $key => $value) {
    		$sol["sportsmanship"] = pow(($value['sportsmanship'] - $matriksolusi_ideal['positif']['sportsmanship']),2);
    		$sol["teamwork"] = pow(($value['teamwork'] - $matriksolusi_ideal['positif']['teamwork']),2);
    		$sol["ability"] = pow(($value['ability'] - $matriksolusi_ideal['positif']['ability']),2);
    		$sol["dayatahan"] = pow(($value['dayatahan'] - $matriksolusi_ideal['positif']['dayatahan']),2);
    		$sol["strategi"] = pow(($value['strategi'] - $matriksolusi_ideal['positif']['strategi']),2);
    		$sol["keterampilan"] = pow(($value['keterampilan'] - $matriksolusi_ideal['positif']['keterampilan']),2);
    		$sol["kecepatan"] = pow(($value['kecepatan'] - $matriksolusi_ideal['positif']['kecepatan']),2);
    		
    		$solusi_positif[] = [
	    		"team_id"	=> $value['team_id'],
				"team_name"	=> $value['team_name'],

				"sportsmanship"	=> $sol['sportsmanship'],
	    		"teamwork"		=> $sol['teamwork'],
	    		"ability"		=> $sol['ability'],
	    		"dayatahan"		=> $sol['dayatahan'],
	    		"strategi"		=> $sol['strategi'],
				"keterampilan"	=> $sol['keterampilan'],
	    		"kecepatan"		=> $sol['kecepatan'],
	    		"total"			=> sqrt(array_sum($sol)),
	    	];
    	}
    	// $this->response($solusi_positif);

    	// JARAK SOLUSI NEGATIF
    	$solusi_negatif = [];

    	foreach ($matriknilai_normalisasi_terbobot as $key => $value) {
    		$sol["sportsmanship"] = pow(($value['sportsmanship'] - $matriksolusi_ideal['negatif']['sportsmanship']),2);
    		$sol["teamwork"] = pow(($value['teamwork'] - $matriksolusi_ideal['negatif']['teamwork']),2);
    		$sol["ability"] = pow(($value['ability'] - $matriksolusi_ideal['negatif']['ability']),2);
    		$sol["dayatahan"] = pow(($value['dayatahan'] - $matriksolusi_ideal['negatif']['dayatahan']),2);
    		$sol["strategi"] = pow(($value['strategi'] - $matriksolusi_ideal['negatif']['strategi']),2);
    		$sol["keterampilan"] = pow(($value['keterampilan'] - $matriksolusi_ideal['negatif']['keterampilan']),2);
    		$sol["kecepatan"] = pow(($value['kecepatan'] - $matriksolusi_ideal['negatif']['kecepatan']),2);
    		
    		$solusi_negatif[] = [
	    		"team_id"	=> $value['team_id'],
				"team_name"	=> $value['team_name'],

				"sportsmanship"	=> $sol['sportsmanship'],
	    		"teamwork"		=> $sol['teamwork'],
	    		"ability"		=> $sol['ability'],
	    		"dayatahan"		=> $sol['dayatahan'],
	    		"strategi"		=> $sol['strategi'],
				"keterampilan"	=> $sol['keterampilan'],
	    		"kecepatan"		=> $sol['kecepatan'],
	    		"total"			=> sqrt(array_sum($sol)),
	    	];
    	}
    	// $this->response($solusi_negatif);

    	// NILAI PREFERENSI
    	$nilai_preferensi = [];
    	foreach ($team as $key => $value) {
    		// yang ditampilkan nilai preferensi selain tim yang sedang login
    		// untuk menghindari munculnya tim diri sendiri
    		if ($teamId != $value->id) {
                $nilai = $this->rating_model->getDataAvg($value->id);
                $nilai_preferensi[] = [
                    "team_id"   => $value->id,
                    "team_name" => $value->name,

                    "positif"   => $solusi_positif[$key]['total'],
                    "negatif"   => $solusi_negatif[$key]['total'],
                    "preferensi"=> $solusi_negatif[$key]['total'] / ($solusi_positif[$key]['total'] + $solusi_negatif[$key]['total']),
                    "ranking"   => 0, 
                    "sportsmanship" => (double)$nilai['sportsmanship'],
                    "teamwork" => (double)$nilai['teamwork'],
                    "ability" => (double)$nilai['ability'],
                    "dayatahan" => (double)$nilai['dayatahan'],
                    "strategi" => (double)$nilai['strategi'],
                    "keterampilan" => (double)$nilai['keterampilan'],
                    "kecepatan" => (double)$nilai['kecepatan'],
                ];

    		}
    	}
    	// $this->response($nilai_preferensi);

    	// urut prefrensi dari terbesar ke terkecil
    	usort($nilai_preferensi, function($a, $b) {
    		if ($a['preferensi']==$b['preferensi']) return 0;
        return ($a['preferensi'] < $b['preferensi']) ? 1 : -1;
		});

		// pemberian nilai ranking
		$ranking = 1;
		foreach ($nilai_preferensi as $key => $value) {
			$nilai_preferensi[$key]['ranking'] = $ranking++;
		}

    	$this->response($nilai_preferensi);

    }
}