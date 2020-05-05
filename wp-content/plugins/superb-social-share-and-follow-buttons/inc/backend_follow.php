<?php
$settings = $this->db->get_settings(2);
$positionSettings = $this->db->get_positionSettings(2);
$currentsc = 'spbsm-follow-buttons';
$currentButtons = __("Follow Buttons", 'spbsm');
$shareOrFollow = __("Follow Us On Social Media Text", 'spbsm');
if ($settings) { ?>
<div class="spbsm-outer-wrapper">

	<form id="spbsm-form" method="post" data-page="follow" name="spbsm-form" action="<?php echo esc_url(home_url()) ?>">
		
		<h1>
			<span>By Superb</span>
			Social Follow Buttons
		</h1>
		<?php include_once $this->base_dir . "readmorebuttons.php"; ?>

		<?php wp_nonce_field('spbsm_submit', '_wpnonce'); ?>
		<main class="spbsm-form-tab-wrapper">
			<input class="spbsm-tabs-input" id="tab1" type="radio" name="tabs" checked>
			<label class="spbsm-tabs-label" for="tab1">General Settings</label>
			<input class="spbsm-tabs-input" id="tab2" type="radio" name="tabs">
			<label class="spbsm-tabs-label" for="tab2">Social Media</label>
			<input class="spbsm-tabs-input" id="tab3" type="radio" name="tabs">
			<label class="spbsm-tabs-label" for="tab3">Design <span class="tab-premiumfeature">Premium Only</span></label>
			<section id="content1">
				<?php include_once $this->base_dir . "/inc/backend-parts/generalform.php"; ?>
				<!-- Section end -->
			</section>
			<section id="content2">
				<div class="spbsm-follow-wrapper">
					<h2><?php printf(__('%s: Social Media', 'spbsm'), $currentButtons);?></h2>
					<p class="headline-description"><?php printf(__('Choose which social media networks you want to display %s for.', 'spbsm'), strtolower($currentButtons));?></p>
					<!-- Follow Options -->
					<table id="media-selection-table" class="spbsm-follow-wrapper">
					<thead>
						<tr>
							<th><?php echo __("Social Media", 'spbsm');?></th>
							<th><?php echo __("Link", 'spbsm');?></th>
							<th><?php echo __("Activate", 'spbsm');?></th>
						</tr>
						</thead>
						<tbody>
						<?php
                        foreach ($settings as &$item) {
                            if ($item && $item['class']!='email') {
                                echo '<tr class="spbsm-follow-item">';
                                echo '<td><a href="#" class="spbsm-follow '.$item['class'].'"></a>';
                                echo $item['class']."\n</td>";
                                echo '<td><input type="text" spbsm="validate" placeholder="Add '.$item['class'].' profile link.." data-site="'.$item['class'].'" name="'.$item['class'].'[follow_url]" value="'.esc_url($item['follow_url']).'"></td>';
                                echo '<td><input type="hidden" value="0" name="'.$item['class'].'[follow]"><input type="checkbox" name="'.$item['class'].'[follow]" '.($item['follow']==1?'checked':'').'>';
                                echo '<input class="queue-value" type="hidden" value="'.$item['follow_queue'].'" name="'.$item['class'].'[follow_queue]" />';
                                echo '<input class="spbsm_dragRow" style="cursor: move;" type="button" /></td>';
                                echo '</tr>';
                            }
                        }
                        ?>
						</tbody>
					</table>
					<!-- -->
				</div>
			</section>
			<section id="content3">
				<?php include_once $this->base_dir . "/inc/backend-parts/designform.php"; ?>
			</section>
				<?php include_once $this->base_dir . "/inc/backend-parts/submitbutton.php"; ?>
		</main>
	</form>
</div>
<?php
}
?>