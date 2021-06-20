<?php

namespace main;

    #patientenklasse
    class Patient {
        public $svnr = 'null';
        public $vorname = 'null';
        public $nachname = 'null';
        public $blutgruppe = 'null';

        public function getSvnr() {
            return $this->svnr;
        }
        public function getName() {
            return $this->nachname;
        }
        public function getSurname() {
            return $this->vorname;
        }
        public function getBloodtype() {
            return $this->blutgruppe;
        }

        public function __construct($svnr, $vorname, $nachname, $blutgruppe)
        {
            $this->svnr = $svnr;
            $this->vorname = $vorname;
            $this->nachname = $nachname;
            $this->blutgruppe = $blutgruppe;
        }
    }
    #terminklasse
    class Termin {
        public $id = 'null';
        public $datum = 'null';
        public $zeit = 'null';
        public $pat1 = 'null';
        public $pat2 = 'null';

        public function getID() {
            return $this->id;
        }
        public function getDate() {
            return $this->datum;
        }
        public function getTime() {
            return $this->zeit;
        }
        public function getSVNR1() {
            return $this->pat1;
        }
        public function getSVNR2() {
            return $this->pat2;
        }

        public function __construct($id, $datum, $zeit, $pat1, $pat2)
        {
            $this->id = $id;
            $this->datum = $datum;
            $this->zeit = $zeit;
            $this->pat1 = $pat1;
            $this->pat2 = $pat2;
        }
    }
    #spende-klasse: bei jeder Spende wird die kompatibilität der patienten (per blutgruppe) ermittelt und zurückgegeben
    class Spende{
        protected $compatibility = 0;
        public function getCompatibility() {
            return $this->compatibility;
        }
        public function __construct($donator, $receiver) {

            if($donator->getBloodtype() == "0-"){
                $this->compatibility = 1;
            }
            if($donator->getBloodtype() == "0+"){
                if($receiver->getBloodtype() == "0+"|| $receiver->getBloodtype() == "b+"|| $receiver->getBloodtype() == "a+" || $receiver->getBloodtype() == "ab+"){
                    $this->compatibility = 1;

                }
                else{
                    $this->compatibility = 0;
                }
            }
            if($donator->getBloodtype() == "b-"){
                if($receiver->getBloodtype() == "b-"|| $receiver->getBloodtype() == "b+"|| $receiver->getBloodtype() == "ab-" || $receiver->getBloodtype() == "ab+"){
                    $this->compatibility = 1;

                }
                else{
                    $this->compatibility = 0;
                }
            }
            if($donator->getBloodtype() == "b+"){
                if($receiver->getBloodtype() == "b+"|| $receiver->getBloodtype() == "ab+"){
                    $this->compatibility = 1;

                }
                else{
                    $this->compatibility = 0;
                }
            }
            if($donator->getBloodtype() == "a-"){
                if($receiver->getBloodtype() == "a-"|| $receiver->getBloodtype() == "a+"|| $receiver->getBloodtype() == "ab-" || $receiver->getBloodtype() == "ab+"){
                    $this->compatibility = 1;

                }
                else{
                    $this->compatibility = 0;
                }
            }
            if($donator->getBloodtype() == "a+"){
                if($receiver->getBloodtype() == "a+"|| $receiver->getBloodtype() == "ab+"){
                    $this->compatibility = 1;

                }
                else{
                    $this->compatibility = 0;
                }
            }
            if($donator->getBloodtype() == "ab-"){
                if($receiver->getBloodtype() == "ab+"|| $receiver->getBloodtype() == "ab-"){
                    $this->compatibility = 1;

                }
                else{
                    $this->compatibility = 0;
                }
            }
            if($donator->getBloodtype() == "ab+"){
                if($receiver->getBloodtype() == "ab+"){
                    $this->compatibility = 1;

                }
                else{
                    $this->compatibility = 0;
                }
            }
        }
    }
    #arrays zum speichern der patienten und termine
    $array = [
    0 => new Patient("null", "null", "null", "null")
    ];
    $appointments = [
        0 => new Termin("0", "2021-10-03", "12:30", "1", "2")
    ];
    echo"OSKA - OrganSpende Kompatibilitäts Applikation";
    echo "\n- ♫ made on  ♪ -\n\n";

    echo "+-------------------------------------------------------------------+";
    echo "\n|➤ 'help' or '?' - this view                                        |";
    echo "\n|➤ 1: 'new' - create a new patient                                  |";
    echo "\n|➤ 2: 'all' - print all patients                                    |";
    echo "\n|➤ 3: 'one' - print one patients                                    |";
    echo "\n|➤ 4: 'appointment' - create and view appointments                  |";
    echo "\n|➤ 5: 'quick eval' - quickly evaluate compatibility of two patients |";
    echo "\n|➤ 6: 'eval' - evaluate compatibility of two patients               |";
    echo "\n|➤ 7: 'search' - look for patients who are compatible               |";
    echo "\n+-------------------------------------------------------------------+\n";

    #userinput-loop:
    for ($i = 1; $i <= 500; $i++){
        echo"\n\nMENÜ▶︎";
        $fn = readline();
        echo"\e[25m";
        if($fn == "help" || $fn == "?") { #print all commands
            echo "+-------------------------------------------------------------------+";
            echo "\n|➤ 'help' or '?' - this view                                        |";
            echo "\n|➤ 1: 'new' - create a new patient                                  |";
            echo "\n|➤ 2: 'all' - print all patients                                    |";
            echo "\n|➤ 3: 'one' - print one patients                                    |";
            echo "\n|➤ 4: 'appointment' - create and view appointments                  |";
            echo "\n|➤ 5: 'quick eval' - quickly evaluate compatibility of two patients |";
            echo "\n|➤ 6: 'eval' - evaluate compatibility of two patients               |";
            echo "\n|➤ 7: 'search' - look for patients who are compatible               |";
            echo "\n+-------------------------------------------------------------------+\n";
        }
        if($fn == "new" || $fn == "1"){ #create new patient instance
            echo"\n<svnr>: ";
            $svnr = readline();
            echo"<vorname>: ";
            $name = readline();
            echo"<nachname>: ";
            $surname = readline();
            echo"<blutgruppe>: ";
            $bloodtype = readline();
            if($svnr!="" && $bloodtype=="a+"||$bloodtype=="a-"||$bloodtype=="b+"||$bloodtype=="b-"||$bloodtype=="ab+"||$bloodtype=="ab-"||$bloodtype=="0+"||$bloodtype=="0-"){
                $patient = new Patient($svnr, $surname, $name, $bloodtype);
                $array[$svnr] = $patient;
                echo "\e[32m✔︎ Der Patient wurde angelegt\e[0m";
            }
            else{
                echo"\e[31mERROR⫸ die eingabe ist ungültig: bitte geben sie einen nummerischen wert als SVNR und einen Kleinbuchstaben inklusive einer Polarität als Blutgruppe ein (zB.: b-)\e[0m";
            }
        }
        if($fn == "all" || $fn == "print" || $fn == "2"){ #print all patients
            foreach ($array as &$value) {
                echo "\n<svnr>: ", $value->getSvnr();
                echo "\n<vorname>: ", $value->getName();
                echo "\n<nachname>: ", $value->getSurname();
                echo "\n<blutgruppe>: ", $value->getBloodtype();
                echo "\n";
            }
        }
        if($fn == "one" || $fn == "get" || $fn == "3"){ #print all patients
            echo"<svnr>: ";
            $id = readline();
            if($id!="") {
                try {
                    echo "\n<svnr>: ", $array[$id]->getSvnr();
                    echo "\n<vorname>: ", $array[$id]->getName();
                    echo "\n<nachname>: ", $array[$id]->getSurname();
                    echo "\n<blutgruppe>: ", $array[$id]->getBloodtype();
                } catch (Error $e) {
                    echo "\e[31mERROR⫸ ", $e->getMessage(), "\e[0m\n";
                }
            }
        }
        if($fn == "search" || $fn == "look" || $fn == "7"){ #look for compatible patients
            echo"\n<svnr>: ";
            $id = readline();
            if($id!="") {
                try {
                    $bt = $array[$id]->getBloodtype();
                    echo "\npossible compatibilities found:";
                    foreach ($array as &$value) {
                        if ($array[$id] != $value) {
                            $patient1 = new Patient("lsdjfckljdsNVJKN", "testuser", "testuser", $bt);
                            $patient2 = new Patient("JHBFlkjbelFHFJhe", "testuser", "testuser", $value->getBloodtype());
                            $spende = new Spende($patient2, $patient1);
                            if ($spende->getCompatibility() == 1) {
                                echo "\npatient with SVNR: ", $value->getSVNR();
                            }
                        }
                    }
                    echo "\n";
                } catch (Error $e) {
                    echo "\e[31mERROR⫸ ", $e->getMessage(), "\e[0m\n";
                }
            }
            else{
                echo"\e[31mERROR⫸ non-valid SVNR\e[0m";
            }
        }
        if($fn == "appointment" || $fn == "termin" || $fn == "4"){ #appointments
            echo"\n<'create' or 'display'>: ";
            $appFn = readline();

            if($appFn == "create" || $appFn == "1"){
                echo"\n<termin-id>: ";
                $id = readline();
                echo"<datum>: ";
                $date = readline();
                echo"<zeit>: ";
                $time = readline();
                echo"<svnr-donator>: ";
                $pat1 = readline();
                echo"<svnr-reciever>: ";
                $pat2 = readline();

                $patient1 = new Patient("lsdjfckljdsNVJKN", "testuser", "testuser", $array[$pat1]->getBloodtype());
                $patient2 = new Patient("JHBFlkjbelFHFJhe", "testuser", "testuser", $array[$pat2]->getBloodtype());
                $spende = new Spende($patient2, $patient1);

                echo"\n+---------------------+";
                echo"\n|Compatibility: ";
                if($spende->getCompatibility() == 1){
                    echo "true |";
                    echo"\n+---------------------+";
                    echo "\n\e[32m--> ✔︎ Die Patienten sind kompatibel.\e[39m\n";
                    $appointment = new Termin($id, $date, $time, $pat1, $pat2);
                    $appointments[$id] = $appointment;
                    echo "\n\e[32m➔Der Termin wurde angelegt\e[0m";
                }
                elseif ($spende->getCompatibility() == 0){
                    echo"false |";
                    echo"\n+---------------------+";
                    echo "\n\e[31m--> ✖︎ Die Patienten sind nicht kompatibel.\e[39m\n";
                    echo "\n\e[31m➔Der Termin wurde daher nicht angelegt\e[0m";

                }
                else {
                    echo "error |";
                }

            }
            if($appFn == "display" || $appFn == "2") {
                foreach ($appointments as &$app) {
                    echo "\n#";
                    echo "termin-id: ", $app->getID();
                    echo "\n<datum>: ", $app->getDate();
                    echo "\n<zeit>: ", $app->getTime();
                    echo "\n<svnr-1>: ", $app->getSVNR1();
                    echo "\n<svnr-2>: ", $app->getSVNR2(), "\n";
                }
            }
        }
        if($fn == "quick eval" || $fn == "quick" || $fn == "5"){ #schnelle evaluierung der kompatibilität nur unter eingabe der blugruppe
            echo"\nBitte geben sie die Blutgruppen der zwei Patienten ein, deren Kompatibilität Sie überprüfen wollen.";
            echo"\n<blutgruppe/donator>: ";
            $p1 = readline();
            echo"<blutgruppe/receiver>: ";
            $p2 = readline();

            $patient1 = new Patient("lsdjfckljdsNVJKN", "testuser", "testuser", $p1);
            $patient2 = new Patient("JHBFlkjbelFHFJhe", "testuser", "testuser", $p2);

            $spende = new Spende($patient1, $patient2);

            echo"\n+---------------------+";
            echo"\n|Compatibility: ";
            if($spende->getCompatibility() == 1){
                echo "true |";
                echo"\n+---------------------+";
                echo "\n\e[32m--> ✔︎ Die Patienten sind kompatibel.\e[39m\n";
            }
            elseif ($spende->getCompatibility() == 0){
                echo"false |";
                echo"\n+---------------------+";
                echo "\n\e[31m--> ✖︎ Die Patienten sind nicht kompatibel.\e[39m\n";
            }
            else {
                echo "error |";
            }
        }
        if($fn == "eval" || $fn == "6"){ #evaluate compatibility
            echo"\nBitte geben sie die SVNRs der zwei Patienten ein, deren Kompatibilität Sie überprüfen wollen.";
            echo"\n<svnr/donator>: ";
            $p1 = readline();
            echo"<svnr/receiver>: ";
            $p2 = readline();

            try {
                if ($p1 != "" && $p2 != "") {
                    $spende = new Spende($array[$p1], $array[$p2]);

                    echo "\n+---------------------+";
                    echo "\n|Compatibility: ";
                    if ($spende->getCompatibility() == 1) {
                        echo "true |";
                        echo "\n+---------------------+";
                        echo "\n\e[32m--> Die Patienten patients: \e[4m", $array[$p1]->getSurname(), " ", $array[$p1]->getName(), "\e[0m\e[32m und \e[4m", $array[$p2]->getSurname(), " ", $array[$p2]->getName(), "\e[0m\e[32m sind kompatibel.\e[39m";
                    } elseif ($spende->getCompatibility() == 0) {
                        echo "false |";
                        echo "\n+---------------------+";
                        echo "\n\e[31m--> ✖︎ Die Patienten: \e[4m", $array[$p1]->getSurname(), " ", $array[$p1]->getName(), "\e[0m\e[31m und \e[4m", $array[$p2]->getSurname(), " ", $array[$p2]->getName(), "\e[0m\e[31m sind nicht kompatibel.\e[39m";
                    } else {
                        echo "error |";
                    }
                }
            }
            catch (Error $e) {
                echo "\e[31mERROR⫸ ", $e->getMessage(), "\e[0m\n";
            }
        }
    }
