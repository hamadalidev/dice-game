<?php

class Game
{
    private $playerNumber;
    private $diceNumber;
    private $gameStatus;
    private $gameResult = [];

    public function __construct()
    {
        $this->diceNumber = 0;
        $this->playerNumber = 0;
        $this->gameStatus = true;
    }

    /**
     * this fucction is use for save game start points;
     * @return void
     */
    private function setGameInit()
    {
        for ($players = 0; $players < $this->playerNumber; $players ++) {
            $this->gameResult[] = array(
                'dice' => $this->diceNumber,
                'points' => 0,
                'dice_results' => [],
                'dice_results_evaluation' => []
                );
        }
    }

    /**
     * This function is use for start game
     * @param int $playerNumber
     * @param int $diceNumber
     * @return void
     */
    public function play(int $playerNumber, int $diceNumber)
    {
        $this->playerNumber = $playerNumber;
        $this->diceNumber = $diceNumber;
        $this->setGameInit();
        $count = 1;
        do{
            echo "==============================\n";
            echo "Turn $count roll the dice\n";
            $count++;
            $this->playerTurn();
        }while($this->gameStatus);
        $this->printResult();

    }

    /**
     * This function is use for player turn for roll rice
     * @return void
     */
    private function playerTurn()
    {
        for ($players = 0; $players < $this->playerNumber; $players ++) {
            $this->diceRoles($players);
        }

        echo "After evaluation: \n";
        for ($players = 0; $players < $this->playerNumber; $players ++) {
            $this->calculateEvaluation($players);
        }


        $playersCount = 0;
        for ($players = 0; $players < $this->playerNumber; $players++) {
            $this->printEvaluation($players);
            $this->calculateDice($players);
            if ($this->gameResult[$players]['dice'] != 0) {
                $playersCount++;
            }
        }
        if ($playersCount == 1) {
            $this->gameStatus = false;
        }
    }

    /**
     * this function is use for clculate dice number after turn
     * @param $player
     * @return void
     */
    private function calculateDice($player)
    {
        $this->gameResult[$player]['dice'] = count($this->gameResult[$player]['dice_results_evaluation']);
    }

    /**
     * This function is use for dice roll
     * @param $player
     * @return void
     */
    private function diceRoles($player)
    {
        $dice = $this->gameResult[$player]['dice'];
        $this->gameResult[$player]['dice_results']=[];
        $this->gameResult[$player]['dice_results_evaluation']=[];
        while ($dice > 0){
            $this->gameResult[$player]['dice_results'][] = rand(1,6);
            $dice--;
        }
        $this->printTurnRoll($player);
    }

    /**
     * This function is use for print roll result
     * @param $player
     * @return void
     */
    private function printTurnRoll($player)
    {
        $playerNum = $player + 1;
        echo "Player #" . $playerNum . "  (".$this->gameResult[$player]['points']."): ";
        if (count($this->gameResult[$player]['dice_results']) == 0) {
            echo " _ (Stop playing because it has no dice) \n";
        } else {
            echo implode(', ', $this->gameResult[$player]['dice_results']) . "\n";
        }
    }

    /**
     * This function is use for print evaluation after player turn
     * @param $player
     * @return void
     */
    private function printEvaluation($player)
    {
        $playerNum = $player + 1;
        echo "Player #" . $playerNum . " (".$this->gameResult[$player]['points']."): ";
        if (count($this->gameResult[$player]['dice_results_evaluation']) == 0) {
            echo " _ (Stop playing because it has no dice) \n";
        } else {
            echo implode(', ', $this->gameResult[$player]['dice_results_evaluation']) . "\n";
        }
    }

    /**
     * This funciton is use for print result.
     * @return void
     */
    private function printResult()
    {
        $max = 0;
        $maxPoint = 0;
        for ($players = 0; $players < $this->playerNumber; $players ++) {
            if ($maxPoint < $this->gameResult[$players]['points']) {
                $max = $players+1;
                $maxPoint = $this->gameResult[$players]['points'];
            }
        }
        echo "========================== \n";
        echo "Game won by player #$max because it has more points than other players\n";
        echo "========================== \n";
    }

    /**
     * This function is ue for calculate turn evaluation.
     * @param $player
     * @return void
     */
    private function calculateEvaluation($player)
    {
          $arrayDiff = array_diff($this->gameResult[$player]['dice_results'], [1,6]);
          foreach ($arrayDiff as $item) {
              $this->gameResult[$player]['dice_results_evaluation'][] = $item;
          }
        $resultWithCount = array_count_values($this->gameResult[$player]['dice_results']);

        if (isset($resultWithCount[6])) {
            $this->gameResult[$player]['points'] = $this->gameResult[$player]['points'] + $resultWithCount[6];
        }

        if (isset($resultWithCount[1])) {
            $nextPlayer = $player + 1;
            if ($player == $this->playerNumber - 1) {
                $nextPlayer =  0;
            }

            $totalOne = $resultWithCount[1];
            while($totalOne > 0) {
                $totalOne--;
                $this->gameResult[$nextPlayer]['dice_results_evaluation'][] = 1;
            }
        }
    }
}


$game = new Game();

/**
 * set number for player
 */
$playerNumber = 3;

/**
 * set number for dice number
 */
$diceNumber = 4;
$game->play($playerNumber, $diceNumber);
