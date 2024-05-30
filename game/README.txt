README (250 words)
. I couldn't use original image because it was soo small and didn't fit so I used another image from the same creator
. ssh: (ssh -p 60943 ecm1417@ml-lab-4d78f073-aa49-4f0e-bce2-31e5254052c7.ukwest.cloudapp.azure.com)

. index.php (http://ml-lab-4d78f073-aa49-4f0e-bce2-31e5254052c7.ukwest.cloudapp.azure.com:60943/game/index.php)
. displays "register now" if not registered, otherwise displays "Click here to play", 
. if already registered it will show the home page and leaderboard(icon next to it) at the top of the page

.registration.php (http://ml-lab-4d78f073-aa49-4f0e-bce2-31e5254052c7.ukwest.cloudapp.azure.com:60943/game/registration.php)
. medium complexity chosen: allows you to choose 6 different icons and displays it next to the leaderboard
. Lets you input a unique username

.pairs.php (http://ml-lab-4d78f073-aa49-4f0e-bce2-31e5254052c7.ukwest.cloudapp.azure.com:60943/game/pairs.php)
. complex difficulty chosen: all card images are randomly configurated for every play through of each level
. each level has a timer and number of attempts that dictates the points awarded. after exceeding 15 attempts , you lose.
. beating a previous record should prompt the background color to change to gold
. click on a card to flip, stays up if 2 or more are matched, otherwise flipped back

.level 1: 6 cards that are matched with 2 pairs
.level 2: 10 cards that are matched with 3pairs
.level 3: 16 cards that are matched with 4 pairs
.game ends once all levels complete, user leaves, user fails level, too many attempts(15+)

leaderboard.php (http://ml-lab-4d78f073-aa49-4f0e-bce2-31e5254052c7.ukwest.cloudapp.azure.com:60943/game/leaderboard.php)
.Displays usernames , points for each level earned , and points overall onto a table
. home, play pairs , leadboards at the top
.complete all levels for the user to be stored in the leaderboard