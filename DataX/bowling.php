<?php

class BowlingGame {

    public $config;

    public function __construct()
    {
		$this->config = (object)[];
		$this->config->pins = 10;
		$this->config->normal_frames = 9;
		$this->config->end_frames = 1;
		$this->config->rolls_per_frame = 2;
		$this->config->no_tap = 10;	
    }
	
	public function bowlGame()
	{
		$scores = array();
		for ($i = 1; $i <= $this->config->normal_frames; $i++) {
			$frame_score = $this->bowlRegularFrame();
			if ($frame_score[0] === $this->config->pins)
			{
				$frame_score[0] = "X";
			}
			if (array_sum($frame_score) === $this->config->pins)
			{
				$frame_score[count($frame_score)-1] = "/";
			}
			$pretty_score = array_pad($frame_score, $this->config->rolls_per_frame, "-");
			array_push($scores, $pretty_score);
		}
		for ($i = 1; $i <= $this->config->end_frames; $i++) {
			$frame_score = $this->bowlLastFrame();

			if (($frame_score[0] + $frame_score[1]) === $this->config->pins)
			{
				$frame_score[1] = "/";
			}
			elseif (count($frame_score) > 2)
			{
				if (($frame_score[1] + $frame_score[2]) === $this->config->pins)
				{
					$frame_score[2] = "/";
				}
			}
			
			for ($j = 0; $j < count($frame_score); $j++) {
				if ($frame_score[$j] === $this->config->pins)
				{
					$frame_score[$j] = "X";
				}
			}

			$pretty_score = array_pad($frame_score, 3, "-");
			array_push($scores, $pretty_score);
		}
		return $scores;
	}
	
	public function bowlLastFrame()
	{
		$shot = $this->noTapScore($this->throwBall());
		$remaining = $this->config->pins - $shot;
		$score = array();
		array_push($score, $shot);

		for ($i = 0; $i < 1; $i++) {
			if($remaining > 0) {
				$nextShot = $this->throwBall($remaining);
				array_push($score, $nextShot);
				$remaining = $remaining - $nextShot;
			}
			else {
				$remaining = $this->config->pins;
				$nextShot = $this->throwBall();
				array_push($score, $nextShot);
				$remaining = $remaining - $nextShot;
			}
		}
		if(array_sum($score) >= $this->config->pins) {
			$nextShot = $this->throwBall($remaining);
			array_push($score, $nextShot);
		}
		
		return $score;
	}
	
	public function bowlRegularFrame()
	{
		$shot = $this->noTapScore($this->throwBall());
		$remaining = $this->config->pins - $shot;
		$score = array();
		array_push($score, $shot);

		for ($i = 1; $i < $this->config->rolls_per_frame; $i++) {
			if($remaining > 0) {
				$nextShot = $this->throwBall($remaining);
				array_push($score, $nextShot);
				$remaining = $remaining - $nextShot;
			}
		}
		
		return $score;
	}

	public function noTapScore($score)
	{
		if (($this->config->pins - $score) <=  ($this->config->pins - $this->config->no_tap)) {
			return $this->config->pins;
		}
		else {
			return $score;
		}
	}
	
    public function throwBall($pins = null)
	{
	    if ($pins === null) {
			$pins = $this->config->pins;
		}
		return rand(0,$pins);
	}
}

$game = new BowlingGame;
$game_score = $game->bowlGame();

$normal_label_format = trim("|" . str_repeat("%7.7s|", $game->config->normal_frames));
$end_label_format = trim(str_repeat("%11.11s|", $game->config->end_frames));
$label_row = vsprintf($normal_label_format, range(1, $game->config->normal_frames));
$label_row .= vsprintf($end_label_format, range((1 + $game->config->normal_frames), ($game->config->end_frames) + $game->config->normal_frames));

$normal_frame_format = trim(str_repeat("%2.2s |", $game->config->rolls_per_frame));
$pins_row = "|";
for ($i = 0; $i < $game->config->normal_frames; $i++) {
	$pins_row .= vsprintf($normal_frame_format, $game_score[$i]);
}
for ($i = 0; $i < $game->config->end_frames; $i++) {
	$adjusted_i = $i + $game->config->normal_frames;
	$format = trim(str_repeat("%2.2s |", count($game_score[$adjusted_i])));
	$pins_row .= vsprintf($format, $game_score[$adjusted_i]);
}

$scores = array();
for ($i = 0; $i < count($game_score); $i++) {
	if (!in_array("X", $game_score[$i], true) && !in_array("/", $game_score[$i], true))
	{
		array_push($scores, array_sum($game_score[$i]));
	}
	elseif (in_array("X", $game_score[$i], true))
	{
		$next_shot = $game_score[$i + 1][0];
		
		if ($next_shot === "X")
		{
			$next_shot = $game->config->pins;
			$next_shot2 = $game_score[$i + 2][0] || 0;
		}
		else {
			$next_shot2 = $game_score[$i + 1][1] || 0;
		}
		
		if ($next_shot2 === "/")
		{
			$next_shot2 = $game->config->pins - $next_shot;
		}

		array_push($scores, $game->config->pins + $next_shot + $next_shot2); // + next 2 throws
	}
	elseif (in_array("/", $game_score[$i], true))
	{
		if (count($game_score) - 1)
		$next_shot = $game_score[$i + 1][0];
		if ($next_shot === "X")
		{
			$next_shot = $game->config->pins;
		}
		array_push($scores, $game->config->pins + $next_shot); // + next 1 throw
	}
}

foreach ($scores as $i => $val) {
    if ($i > 0) {
        $scores[$i] = $scores[$i - 1] + $val;
    }
}

$score_row = vsprintf($normal_label_format, $scores);
$score_row .= vsprintf($end_label_format, range((1 + $game->config->normal_frames), ($game->config->end_frames) + $game->config->normal_frames));

echo $label_row . "\n";
echo $pins_row . "\n";
echo $score_row . "\n";
?>

