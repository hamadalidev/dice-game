# dice-game
Game accepts N number of players and M number of dice as input, with the
following rules:
1. At the start of the game, each player gets a dice of M units.
2. All players will roll their respective dice at the same time
3. Each player will check the results of their roll of the dice and evaluate as follows:

a. Dice number 6 will be removed dice from the game and added as points for that player.

b. Dice number 1 will be awarded dice to the player sitting next to him (pass dice to next person).
For example, the first player will give the dice the number 1 to the second player.

c. Dice numbers 2,3,4 and 5 will still be played by the player.

4. After evaluation, the player who still has the dice will repeat the 2nd step until only 1 player remains.
a. Players who have no more dice are considered to have finished playing.

5. The player who has the most points win.

Example:
Player = 3, Dice = 4


# set game player and dice in Game.php file
$playerNumber = 3;
$diceNumber = 4;

# how to run game?
please run php Game.php

# Game output

==============================

Turn 1 roll the dice

Player #1  (0): 6, 6, 5, 1

Player #2  (0): 1, 3, 4, 1

Player #3  (0): 4, 2, 3, 5

After evaluation:

Player #1 (2): 5

Player #2 (0): 1, 3, 4

Player #3 (0): 1, 1, 4, 2, 3, 5

==============================

Turn 2 roll the dice


Player #1  (2): 6

Player #2  (0): 4, 5, 5

Player #3  (0): 5, 3, 3, 5, 4, 4

After evaluation: 

Player #1 (3):  _ (Stop playing because 
it has no dice) 


Player #2 (0): 4, 5, 5

Player #3 (0): 5, 3, 3, 5, 4, 4

==============================

Turn 3 roll the dice

Player #1  (3):  _ (Stop playing 
because it has no dice) 

Player #2  (0): 2, 2, 5

Player #3  (0): 6, 1, 4, 4, 2, 6

After evaluation: 

Player #1 (3): 1


Player #2 (0): 2, 2, 5

Player #3 (2): 4, 4, 2


==============================

Turn 4 roll the dice


Player #1  (3): 5

Player #2  (0): 4, 6, 4

Player #3  (2): 2, 3, 5

After evaluation: 

Player #1 (3): 5

Player #2 (1): 4, 4

Player #3 (2): 2, 3, 5


==============================


Turn 5 roll the dice

Player #1  (3): 2

Player #2  (1): 6, 6

Player #3  (2): 4, 3, 5

After evaluation: 

Player #1 (3): 2

Player #2 (3):  _ (Stop playing because 
it has no dice) 

Player #3 (2): 4, 3, 5


==============================

Turn 6 roll the dice

Player #1  (3): 6

Player #2  (3):  _ (Stop playing 
because it has no dice) 

Player #3  (2): 2, 2, 2

After evaluation: 

Player #1 (4):  _ (Stop playing because it has no dice) 

Player #2 (3):  _ (Stop playing because it has no dice) 

Player #3 (2): 2, 2, 2


========================== 

Game won by player #1 because it has more points than other players

==========================
