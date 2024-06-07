## index.php
- Displays "register now" if not registered, otherwise displays "Click here to play".
- If already registered, it will show the home page and leaderboard (icon next to it) at the top of the page.

## registration.php
- Medium complexity chosen: allows you to choose 6 different icons and displays it next to the leaderboard.
- Lets you input a unique username.

## pairs.php
- Complex difficulty chosen: all card images are randomly configured for every playthrough of each level.
- Each level has a timer and number of attempts that dictate the points awarded. After exceeding 15 attempts, you lose.
- Beating a previous record should prompt the background color to change to gold.
- Click on a card to flip, stays up if 2 or more are matched, otherwise flipped back.
  - Level 1: 6 cards that are matched with 2 pairs.
  - Level 2: 10 cards that are matched with 3 pairs.
  - Level 3: 16 cards that are matched with 4 pairs.
- Game ends once all levels are complete, user leaves, user fails level, or too many attempts (15+).

## leaderboard.php
- Displays usernames, points for each level earned, and points overall onto a table.
- Home, play pairs, leaderboards at the top.
- Complete all levels for the user to be stored in the leaderboard.
