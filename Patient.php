<?php
    class Patient//Änderungen {
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
    class Termin {
        public $id = '12';
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
    #userinput-loop:
    $array = [
    0 => new Patient("null", "null", "null", "null")
    ];
    $appointments = [
        0 => new Termin("0", "2021-10-03", "12:30", "1", "2")
    ];
    echo"OSKA - OrganSpende Kompatibilitäts Applikation";
    for ($i = 1; $i <= 10; $i++){
        echo"\n>";
        $fn = readline();
        echo"\e[25m";
        if($fn == "help" || $fn == "?"){ #print all commands
              echo"+-----------------------------------------------------------------+";
            echo"\n|'help' or '?' - this view                                        |";
            echo"\n|1: 'new' - create a new patient                                  |";
            echo"\n|2: 'print' - print all patients                                  |";
            echo"\n|3: 'appointment' - create and view appointments                  |";
            echo"\n|4: 'quick eval' - quickly evaluate compatibility of two patients |";
            echo"\n|5: 'eval' - evaluate compatibility of two patients               |";
            echo"\n+-----------------------------------------------------------------+\n";
        }
        if($fn == "new" || $fn == "1"){ #create new patient instance
            echo"\n<svnr>: ";
            $svnr = readline();
            echo"<vorname>: ";
            $surname = readline();
            echo"<nachname>: ";
            $name = readline();
            echo"<blutgruppe>: ";
            $bloodtype = readline();
            $patient = new Patient($svnr, $surname, $name, $bloodtype);
            $array[$svnr] = $patient;
        }
        if($fn == "print" || $fn == "get all" || $fn == "2"){ #print all patients
            foreach ($array as &$value) {
                echo "\n<svnr>: ", $value->getSvnr();
                echo "\n<vorname>: ", $value->getName();
                echo "\n<nachname>: ", $value->getSurname();
                echo "\n<blutgruppe>: ", $value->getBloodtype();
            }
        }
        if($fn == "appointment" || $fn == "termin" || $fn == "3"){ #appointments
            echo"\n<'create' or 'display'>: ";
            $appFn = readline();

            if($appFn == "create" || $appFn == "1"){
                echo"\n<id>: ";
                $id = readline();
                echo"<datum>: ";
                $date = readline();
                echo"<zeit>: ";
                $time = readline();
                echo"<svnr-1>: ";
                $pat1 = readline();
                echo"<svnr-2>: ";
                $pat2 = readline();
                $appointment = new Termin($id, $date, $time, $pat1, $pat2);
                $appointments[$id] = $appointment;
            }
            if($appFn == "display" || $appFn == "2"){
                foreach ($appointments as &$app) {
                    echo "\n#";
                    echo "id: ", $app->getID();
                    echo "\n<datum>: ", $app->getDate();
                    echo "\n<zeit>: ", $app->getTime();
                    echo "\n<svnr-1>: ", $app->getSVNR1();
                    echo "\n<svnr-2>: ", $app->getSVNR2(), "\n";
                }
            }
            else{
                echo"\ninput not recognized";
            }
        }
        if($fn == "quick eval" || $fn == "quick" || $fn == "4"){ #print all patients
            echo"\nBitte geben sie die Blutgruppen der zwei Patienten ein, deren Kompatibilität Sie überprüfen wollen.";
            echo"\n<blutgruppe/p1>: ";
            $p1 = readline();
            echo"<blutgruppe/p2>: ";
            $p2 = readline();

            $patient1 = new Patient("lsdjfckljdsNVJKN", "testuser", "testuser", $p1);
            $patient2 = new Patient("JHBFlkjbelFHFJhe", "testuser", "testuser", $p2);

            $spende = new Spende($patient1, $patient2);

            echo"\n+---------------------+";
            echo"\n|Compatibility: ";
            if($spende->getCompatibility() == 1){
                echo "true |";
                echo"\n+---------------------+";
                echo "\n\e[32m--> the patients: \e[4m", $patient1->getSurname(), " ", $patient1->getName(), "\e[0m\e[32m and \e[4m", $patient2->getSurname(), " ", $patient2->getName(), "\e[0m\e[32m are compatible.\e[39m";
            }
            elseif ($spende->getCompatibility() == 0){
                echo"false |";
                echo"\n+---------------------+";
                echo "\n\e[31m--> the patients: \e[4m", $patient1->getSurname(), " ", $patient1->getName(), "\e[0m\e[31m and \e[4m", $patient2->getSurname(), " ", $patient2->getName(), "\e[0m\e[31m are not compatible.\e[39m";
            }
            else {
                echo "error |";
            }
        }
        if($fn == "eval" || $fn == "5"){ #evaluate compatibility
            echo"\nBitte geben sie die SVNRs der zwei Patienten ein, deren Kompatibilität Sie überprüfen wollen.";
            echo"\n<svnr/p1>: ";
            $p1 = readline();
            echo"<svnr/p2>: ";
            $p2 = readline();

            $spende = new Spende($array[$p1], $array[$p2]);

            echo"\n+---------------------+";
            echo"\n|Compatibility: ";
            if($spende->getCompatibility() == 1){
                echo "true |";
                echo"\n+---------------------+";
                echo "\n\e[32m--> the patients: \e[4m", $array[$p1]->getSurname(), " ", $array[$p1]->getName(), "\e[0m\e[32m and \e[4m", $array[$p2]->getSurname(), " ", $array[$p2]->getName(), "\e[0m\e[32m are compatible.\e[39m";
            }
            elseif ($spende->getCompatibility() == 0){
                echo"false |";
                echo"\n+---------------------+";
                echo "\n\e[31m--> the patients: \e[4m", $array[$p1]->getSurname(), " ", $array[$p1]->getName(), "\e[0m\e[31m and \e[4m", $array[$p2]->getSurname(), " ", $array[$p2]->getName(), "\e[0m\e[31m are not compatible.\e[39m";
            }
            else {wdw
                echo "error |";
            }
        }
    }
?>
