my_game
=======
Short description of php files:

create.php - creates human player, 2 bots, array of bots-info, array of current-standings-data

challenge.php - executes challenge alone and together

challenge_pick.php - creates challenges, handles REQUEST:challenge alone and REQUEST challengeChange

item.php - creates 10 items, REQUEST human plusItem

reset.php - only handles the click function in base.js of the player starting over from scratch.

Please observe: 
- one function is missing in this game compared to the grade requirements: the human player's possibility of loosing an item when not winning a challenge. 
- Parts of one of the 20 G-grade-requirements was skipped by me. It was the part demanding the functions "winTool", "looseTool", "acceptChallenge", "changeChallenge", "carryOutChallenge" and "carryOutChallengeWithCompanion". I found it tricky and difficult to make it work like you asked for. So I choose an easier(in my brain's opinion) way. 
- Reason for the two flaws above: The time ran out on me, and I prioritized delivering an overall functioning game at all.
