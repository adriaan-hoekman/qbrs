<?php
	$tabs = array();

	function tabs_header()
	{
	?>
	<style type="text/css">
	.tab {
/*
		border-left: 1px solid black;
		border-right: 1px solid black;
		border-bottom: 1px solid black;
 */
		text-align: center;
		font-family: arial, verdana;
	  }
	.tab-active {
/*
		border-left: 1px solid black;
		border-top: 1px solid black;
		border-right: 1px solid black;
		border-bottom: 1px solid black;
*/
		text-align: center;
		font-family: arial, verdana;
		font-weight: bold;
	  }
	.tab-content {
		padding: 5px;
		/*
border-left: 1px solid black;
		border-right: 1px solid black;
		border-bottom: 1px solid black;
 */
	  }
	</style>
	<?php
	}

	function tabs_start()
	{
      ob_start();
	}

	function endtab()
	{
	  global $tabs;

	  $text = ob_get_clean();
      $tabs[ count( $tabs ) - 1 ][ 'text' ] = $text;

	  ob_start();
	}

	function tab( $tab_title )
	{
	  global $tabs;

	  if ( count( $tabs ) > 0 )
		endtab();
		$tabs []= array(
		  'title' => $tab_title,
		  'text' => ""
		);
	}

	function tabs_end( )
	{
		global $tabs;

		endtab( );
		ob_end_clean( );

		$index = 0;
		if (isset($_POST['tabindex'])) {
			$_GET['tabindex'] = $_POST['tabindex'];
		}
		if (isset($_GET['tabindex']) AND $_GET['tabindex']) {
			$index = $_GET['tabindex'];
		}

	  ?>
	  <table width="100%" cellspacing="0" cellpadding="0">
	  <tr>
	  <?php
		$baseuri = $_SERVER['REQUEST_URI'];
		$baseuri = preg_replace( "/\?.*$/", "", $baseuri );
		$curindex = 0;
		foreach( $tabs as $tab )
		{
		   $class = "tab";
		   if ( $index == $curindex )
		   $class ="tab-active";
		?>
		<td class="<?php echo($class); ?>">
		<a href="<?php echo( $baseuri."?tabindex=".$curindex ); ?>">
		<?php echo( $tab['title'] ); ?>
		</a>
		</td>
		<?php
			$curindex += 1;
		 }
		?>
		</tr>
		<tr><td class="tab-content" colspan="<?php echo( count( $tabs ) + 1 ); ?>">
		<?php echo( $tabs[$index ]['text'] ); ?>
		</td></tr>
		</table>
	<?php
		}
	?>