<div style="text-align:center">
	<form method="post" action="<?php echo site_url().'/admin/stats/quickMenu' ?>">
		<input id="thisday" type="radio" value="day" name="quick_menu"><label for=thisday>Today&nbsp;&nbsp;&nbsp;&nbsp;</label>
		<input id="thismonth" type="radio" value="month" name="quick_menu"><label for=thismonth>This month&nbsp;&nbsp;&nbsp;&nbsp;</label>
		<input id="thisyear" type="radio" value="year" name="quick_menu"><label for=thismonth>This year&nbsp;&nbsp;&nbsp;&nbsp;</label>
		<input type="submit" value="Go" name="submit"><br/>
	</form>
	<form method="post" action="<?php echo site_url().'/admin/stats/byDate' ?>">
		Start Date: 
		<select name="start_year">
		<?php
			$from_year = $year_stats_from;
			$this_year = date('Y');
			while($from_year <= $this_year):
		?>
				<option value="<?php echo $from_year ?>" <?php echo $from_year == $this_year ? 'SELECTED':'' ?>><?php echo $from_year ?></option>
		<?php
				$from_year++;
			endwhile;
		?>
		</select>
		<select name="start_month">
		<?php
			$this_month = date('m');
			for($i = 1; $i <= 12; $i++):
		?>
				<option value="<?php echo $i ?>" <?php echo $i == $this_month ? 'SELECTED':'' ?>><?php echo $i ?></option>
		<?php
			endfor;
		?>
		</select>
		<select name="start_day">
		<?php
			$this_day = date('d');
			for($i = 1; $i <= 31; $i++):
		?>
				<option value="<?php echo $i ?>" <?php echo $i == 1 ? 'SELECTED':'' ?>><?php echo $i ?></option>
		<?php
			endfor;
		?>
		</select>
		end Date: 
		<select name="end_year">
		<?php
			$from_year = $year_stats_from;
			while($from_year <= $this_year):
		?>
				<option value="<?php echo $from_year ?>" <?php echo $from_year == $this_year ? 'SELECTED':'' ?>><?php echo $from_year ?></option>
		<?php
				$from_year++;
			endwhile;
		?>
		</select>
		<select name="end_month">
		<?php
			for($i = 1; $i <= 12; $i++):
		?>
				<option value="<?php echo $i ?>" <?php echo $i == $this_month ? 'SELECTED':'' ?>><?php echo $i ?></option>
		<?php
			endfor;
		?>
		</select>
		<select name="end_day">
		<?php
			for($i = 1; $i <= 31; $i++):
		?>
				<option value="<?php echo $i ?>" <?php echo $i == $this_day ? 'SELECTED':'' ?>><?php echo $i ?></option>
		<?php
			endfor;
		?>
		</select>
		<input type="submit" value="Go" name="submit"><br/>
		</form>
		<form method="post" action="<?php echo site_url().'/admin/stats/byMonth' ?>">
		By Month:
		<select name="by_month_year">
		<?php
			$from_year = $year_stats_from;
			while($from_year <= $this_year):
		?>
				<option value="<?php echo $from_year ?>" <?php echo $from_year == $this_year ? 'SELECTED':'' ?>><?php echo $from_year ?></option>
		<?php
				$from_year++;
			endwhile;
		?>
		</select>
		<select name="by_month_month">
		<?php
			for($i = 1; $i <= 12; $i++):
		?>
				<option value="<?php echo $i ?>" <?php echo $i == $this_month ? 'SELECTED':'' ?>><?php echo $i ?></option>
		<?php
			endfor;
		?>
		</select>
		<input type="submit" value="Go" name="submit"><br/>
	</form>
</div>