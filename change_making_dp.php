<?php

//You go to a vending machine because you are thirsty. You buy a Fanta
//which costs 420 HUF but you only have a 5000 HUF banknote. You put
//the banknote in and the machine gives back the change. 

function changeMakingProblemDP($costOfItem, $amountPaid)
{
    // 4580 = 5000 - 420
    $changeToMake = $amountPaid - $costOfItem;
    $coinsAvailable = [1,2,5,10,20,50,100,500,1000,2000,5000,10000,20000];

    $coinAmount = array_fill(0, $changeToMake + 1, $changeToMake+1);
    $coinUsed = array_fill(0, $changeToMake + 1, 0);
    $coinAmount[0] = 0;
    // [0, 4581, 4581 ... 4581]

    for($i = 1; $i < count($coinAmount); $i++){
        for($j = 0; $j < count($coinsAvailable); $j++){
            if($coinsAvailable[$j] > $i){
                break;
            }

            if($coinAmount[$i] > 1 + $coinAmount[$i - $coinsAvailable[$j]]){
                $coinAmount[$i] = 1 + $coinAmount[$i - $coinsAvailable[$j]];
                $coinUsed[$i] = $coinsAvailable[$j];
            }
        }
    }

    $change = [];
    $i = $changeToMake;
    while($i > 0){
        $change[] = $coinUsed[$i];
        $i -= $coinUsed[$i];
    }

    return $change;
}