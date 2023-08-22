<?php

/**
 * Template Name: Financial Performance
 */

get_header();

$yearly_performance = get_field("yearly_performance");
$previous_year = get_field("previous_year");
$current_year = get_field("current_year");

$share_capital = array();
$reserves_and_other_funds = array();
$total_advances = array();
$deposits = array();
$profit__loss = array();
$dividend = array();

$yearsArr = array();
foreach ($yearly_performance as $key => $performance) {
	$year = $performance['year'];
	$yearsArr[] = $year;
	$share_capital[$year] = $performance['share_capital'];
	$reserves_and_other_funds[$year] = $performance['reserves_and_other_funds'];
	$total_advances[$year] = $performance['total_advances'];
	$deposits[$year] = $performance['deposits'];
	$profit__loss[$year] = $performance['profit__loss'];
	$dividend[$year] = $performance['dividend'];
}

$PerformanceArr = array(
	'share_capital' => $share_capital,
	'reserves_and_other_funds' => $reserves_and_other_funds,
	'total_advances' => $total_advances,
	'deposits' => $deposits,
	'profit__loss' => $profit__loss,
	'dividend' => $dividend,
);

$labels = array(
	'share_capital' => __("Share Capital", "gsc-bank"),
	'reserves_and_other_funds' => __("Reserves and Other Funds", "gsc-bank"),
	'total_advances' => __("Total Advances", "gsc-bank"),
	'deposits' => __("Share Capital", "gsc-bank"),
	'profit__loss' => __("Deposits", "gsc-bank"),
	'dividend' => __("Dividend", "gsc-bank"),
);


?><div class="<?php echo esc_attr( visualcomposerstarter_get_content_container_class() ); ?>">
	<div class="content-wrapper">
		<div class="row">
			<div class="<?php echo esc_attr( visualcomposerstarter_get_maincontent_block_class() ); ?>">
				<div class="main-content">
					<div class="vc_row wpb_row vc_row-fluid">
						<div class="tab-list-color wpb_column vc_column_container vc_col-sm-4">
							<div class="vc_column-inner">
								<div class="wpb_wrapper">
									<h2 style="font-size: 18px; font-family:Abril Fatface; font-weight:400;" class="vc_custom_heading vc_custom_1690179952383"><a href="<?php echo home_url('about-us'); ?>"><?php _e('ABOUT GSC BANK', 'gsc-bank');?></a></h2>
									<h2 style="font-size: 18px; font-family:Abril Fatface; font-weight:400;" class="vc_custom_heading vc_custom_1690179952383"><a href="<?php echo home_url('board-of-directors'); ?>"><?php _e('BOARD OF DIRECTORS', 'gsc-bank');?></a></h2>
									<h2 style="font-size: 18px; font-family:Abril Fatface; font-weight:400;" class="vc_custom_heading vc_custom_1690179952383"><a href="<?php echo home_url('chairmans-message'); ?>"><?php _e('CHAIRMAN’S MESSAGE', 'gsc-bank');?></a></h2>
									<h2 style="font-size: 18px;color: #5b5b5b;text-align: left;font-family:Abril Fatface;font-weight:400;font-style:normal" class="vc_custom_heading active vc_custom_1690180730672"><a href="<?php echo home_url('financial-performance'); ?>" title="Financial Performance"><?php _e('FINANCIAL PERFORMANCE', 'gsc-bank');?></a></h2>
									<h2 style="font-size: 18px; font-family:Abril Fatface; font-weight:400;" class="vc_custom_heading vc_custom_1690179952383"><a href="<?php echo home_url('awards-recognition'); ?>"><?php _e('AWARDS & RECOGNITION', 'gsc-bank');?></a></h2>
									<h2 style="font-size: 18px; font-family:Abril Fatface; font-weight:400;" class="vc_custom_heading vc_custom_1690179952383"><a href="<?php echo home_url('dccbs-details'); ?>"><?php _e('DCCB’S DETAILS', 'gsc-bank');?></a></h2>
									<h2 style="font-size: 18px; font-family:Abril Fatface; font-weight:400;" class="vc_custom_heading vc_custom_1690179952383"><a href="<?php echo home_url('technology-umbrella-3'); ?>"><?php _e('TECHNOLOGY UMBRELLA', 'gsc-bank');?></a></h2>
									<h2 style="font-size: 18px; font-family:Abril Fatface; font-weight:400;" class="vc_custom_heading vc_custom_1690179952383"><a href="<?php echo home_url('our-vision'); ?>"><?php _e('OUR VISION', 'gsc-bank');?></a></h2>
									<h2 style="font-size: 18px; font-family:Abril Fatface; font-weight:400;" class="vc_custom_heading vc_custom_1690179952383"><a href="<?php echo home_url('events-gallery'); ?>"><?php _e('EVENTS & GALLERY', 'gsc-bank');?></a></h2>
								</div>
							</div>
						</div>
						<div class="wpb_column vc_column_container vc_col-sm-8">
							<div class="vc_column-inner">
								<div class="wpb_wrapper">
									<div class="vc_row wpb_row vc_inner vc_row-fluid">
										<div class="wpb_column vc_column_container vc_col-sm-12">
											<div class="vc_column-inner vc_custom_1690002552961">
												<div class="wpb_wrapper">	
													<h2 class="vc_custom_1690002520768small-underline-header-txt main-title-blue" style=""> STATISTICAL DATA OF GSCB’S PROGRESS FOR LAST 5 YEARS(RS IN CRORES)</h2>	
												</div>
											</div>
										</div>
									</div>
									<div class="wpb_text_column wpb_content_element ">
										<div class="wpb_wrapper">
											<table id="customers">
												<thead>
													<tr>
														<th scope="col">SR NO.</th>
														<th scope="col">PARTICULARS</th><?php
														foreach ($yearsArr as $key => $year) {
															?><th scope="col"><?php echo esc_html($year); ?></th><?php	
														}
													?></tr>
												</thead>
												<tbody><?php
												$count = 1;
												foreach ($PerformanceArr as $key => $performance) {
													?><tr>
														<td><?php echo $count; ?></td>
														<td><?php echo $labels[$key]; ?></td><?php
														foreach ($yearsArr as $key2 => $year) {
															?><td><?php echo $performance[$year]; ?></td><?php
														}
														
													?></tr><?php
													$count++;
												}
												?></tbody>
											</table>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="vc_row wpb_row vc_row-fluid">
					    <div class="wpb_column vc_column_container vc_col-sm-12">
					    	<div class="vc_column-inner">
						    	<div class="wpb_wrapper">
							        <h2 class="small-underline-header-txt main-title-blue mta-60" style=""> ABRIDGED BALANCE SHEET AND WORKING RESULTS (RS IN LAKHS)</h2>   

							        <div class="wpb_text_column wpb_content_element " id="customer-table">
							            <div class="wpb_wrapper">
							            	<table id="customers">
								                <thead>
								                    <tr>
								                        <th scope="col"><?php _e("PARTICULARS", "gsc-bank");?></th>
								                        <th scope="col"><?php _e('PREVIOUS YEAR', 'gsc-bank'); ?></th>
								                        <th scope="col"><?php _e('CURRENT YEAR','gsc-bank');?></th>
								                    </tr>
								                </thead>
								                <tbody>
													<tr>
														<td><?php _e("BALANCE SHEET","gsc-bank"); ?></td>
														<td><?php echo esc_html($previous_year['balance_sheet']); ?></td>
														<td><?php echo esc_html($current_year['balance_sheet']); ?></td>
													</tr>
													<tr>
														<td><?php _e("CAPITAL","gsc-bank"); ?></td>
														<td><?php echo esc_html($previous_year['capital']); ?></td>
														<td><?php echo esc_html($current_year['capital']); ?></td>
													</tr>
													<tr>
														<td><?php _e("RESERVES & SURPLUS","gsc-bank"); ?></td>
														<td><?php echo esc_html($previous_year['reserves_&_surplus']); ?></td>
														<td><?php echo esc_html($current_year['reserves_&_surplus']); ?></td>
													</tr>
													<tr>
														<td><?php _e("DEPOSITS","gsc-bank"); ?></td>
														<td><?php echo esc_html($previous_year['deposits']); ?></td>
														<td><?php echo esc_html($current_year['deposits']); ?></td>
													</tr>
													<tr>
														<td><?php _e("BORROWINGS","gsc-bank"); ?></td>
														<td><?php echo esc_html($previous_year['borrowings']); ?></td>
														<td><?php echo esc_html($current_year['borrowings']); ?></td>
													</tr>
													<tr>
														<td><?php _e("OTHER LIABILITIES","gsc-bank"); ?></td>
														<td><?php echo esc_html($previous_year['other_liabilities']); ?></td>
														<td><?php echo esc_html($current_year['other_liabilities']); ?></td>
													</tr>
												</tbody>
												<thead>
													<tr>
														<th scope="col"><?php _e("TOTAL LIABILITIES","gsc-bank"); ?></th><?php
															$total_liabilities_previous = floatval($previous_year['capital']) + floatval($previous_year['reserves_&_surplus']) + floatval($previous_year['deposits']) + floatval($previous_year['borrowings']) + floatval($previous_year['other_liabilities']);

															$total_liabilities_current = floatval($current_year['capital']) + floatval($current_year['reserves_&_surplus']) + floatval($current_year['deposits']) + floatval($current_year['borrowings']) + floatval($current_year['other_liabilities']);
														?><th scope="col"><?php echo $total_liabilities_previous; ?></th>
														<th scope="col"><?php echo $total_liabilities_current; ?></th>
													</tr>
												</thead>
												<tbody>
													<tr>
														<td><?php _e("CASH AND BANK BALANCES","gsc-bank"); ?></td>
														<td><?php echo esc_html($previous_year['cash_and_bank_balances']); ?></td>
														<td><?php echo esc_html($current_year['cash_and_bank_balances']); ?></td>
													</tr>
													<tr>
														<td><?php _e("INVESTMENTS","gsc-bank"); ?></td>
														<td><?php echo esc_html($previous_year['investments']); ?></td>
														<td><?php echo esc_html($current_year['investments']); ?></td>
													</tr>
													<tr>
														<td><?php _e("LOANS AND ADVANCES","gsc-bank"); ?></td>
														<td><?php echo esc_html($previous_year['loans_and_advances']); ?></td>
														<td><?php echo esc_html($current_year['loans_and_advances']); ?></td>
													</tr>
													<tr>
														<td><?php _e("OTHER ASSETS","gsc-bank"); ?></td>
														<td><?php echo esc_html($previous_year['other_assets']); ?></td>
														<td><?php echo esc_html($current_year['other_assets']); ?></td>
													</tr>
												</tbody>
												<thead>
													<tr>
														<th scope="col"><?php _e("TOTAL ASSETS","gsc-bank"); ?></th><?php
															$total_assets_previous = floatval($previous_year['cash_and_bank_balances']) + floatval($previous_year['investments']) + floatval($previous_year['deposits']) + floatval($previous_year['loans_and_advances']) + floatval($previous_year['other_assets']);

															$total_assets_current = floatval($current_year['cash_and_bank_balances']) + floatval($current_year['investments']) + floatval($current_year['deposits']) + floatval($current_year['loans_and_advances']) + floatval($current_year['other_assets']);
														?><th scope="col"><?php echo $total_assets_previous; ?></th>
														<th scope="col"><?php echo $total_assets_current; ?></th>
													</tr>
												</thead>
												<tbody>
													<tr>
														<td><strong class="text-g"><?php _e("PROFIT & LOSS ACCOUNT","gsc-bank"); ?></strong></td>
														<td></td>
														<td></td>
													</tr>
													<tr>
														<td><?php _e("INTEREST INCOME","gsc-bank"); ?></td>
														<td><?php echo esc_html($previous_year['interest_income']); ?></td>
														<td><?php echo esc_html($current_year['interest_income']); ?></td>
													</tr>
													<tr>
														<td><?php _e("OTHER INCOME","gsc-bank"); ?></td>
														<td><?php echo esc_html($previous_year['other_income']); ?></td>
														<td><?php echo esc_html($current_year['other_income']); ?></td>
													</tr>
												</tbody>
												<thead>
													<tr>
														<th scope="col"><?php _e("TOTAL ASSETS","gsc-bank"); ?></th><?php
															$total_income_previous = floatval($previous_year['interest_income']) + floatval($previous_year['other_income']);

															$total_income_current = floatval($current_year['interest_income']) + floatval($current_year['other_income']);
														?><th scope="col"><?php echo esc_html($total_income_previous); ?></th>
														<th scope="col"><?php echo esc_html($total_income_current); ?></th>
													</tr>
												</thead>
												<tbody>
													
													<tr>
														<td><?php _e("INTEREST EXPENDITURE","gsc-bank"); ?></td>
														<td><?php echo esc_html($previous_year['interest_expenditure']); ?></td>
														<td><?php echo esc_html($current_year['interest_expenditure']); ?></td>
													</tr>
													<tr>
														<td><?php _e("OTHER EXPENDITURE","gsc-bank"); ?></td>
														<td><?php echo esc_html($previous_year['other_expenditure']); ?></td>
														<td><?php echo esc_html($current_year['other_expenditure']); ?></td>
													</tr>
												</tbody>
												<thead>
													<tr>
														<th scope="col"><?php _e("TOTAL EXPENDITURE","gsc-bank"); ?></th><?php
															$total_expenditure_previous = floatval($previous_year['interest_expenditure']) + floatval($previous_year['other_expenditure']);

															$total_expenditure_current = floatval($current_year['interest_expenditure']) + floatval($current_year['other_expenditure']);
														?><th scope="col"><?php echo esc_html($total_expenditure_previous); ?></th>
														<th scope="col"><?php echo esc_html($total_expenditure_current); ?></th>
													</tr>
												</thead>
												<tbody>
													<tr>
														<td><?php _e("PROFIT/LOSS","gsc-bank"); ?></td>
														<td><?php echo esc_html($previous_year['profit__loss']); ?></td>
														<td><?php echo esc_html($current_year['profit__loss']); ?></td>
													</tr>
												</tbody>
												<thead>
													<tr>
														<th scope="col"><?php _e("OTHER WORKING RESULT","gsc-bank"); ?></th>
														<th scope="col"><?php echo ''; ?></th>
														<th scope="col"><?php echo ''; ?></th>
													</tr>
												</thead>
												<tbody>
													<tr>
														<td><?php _e("CD RATIO (%)","gsc-bank"); ?></td>
														<td><?php echo esc_html($previous_year['cd_ratio']); ?></td>
														<td><?php echo esc_html($current_year['cd_ratio']); ?></td>
													</tr>
													<tr>
														<td><?php _e("RECOVERY PERFORMANCE (%)","gsc-bank"); ?></td>
														<td><?php echo esc_html($previous_year['recovery_performance_']); ?></td>
														<td><?php echo esc_html($current_year['recovery_performance_']); ?></td>
													</tr>
													<tr>
														<td><?php _e("GROSS NPAS","gsc-bank"); ?></td>
														<td><?php echo esc_html($previous_year['gross_npas']); ?></td>
														<td><?php echo esc_html($current_year['gross_npas']); ?></td>
													</tr>
													<tr>
														<td><?php _e("NET NPAS","gsc-bank"); ?></td>
														<td><?php echo esc_html($previous_year['net_npas']); ?></td>
														<td><?php echo esc_html($current_year['net_npas']); ?></td>
													</tr>
													<tr>
														<td><?php _e("% OF GROSS NPAS TO TOTAL ADVANCES","gsc-bank"); ?></td>
														<td><?php echo esc_html($previous_year['%_of_gross_npas_to_total_advances']); ?></td>
														<td><?php echo esc_html($current_year['%_of_gross_npas_to_total_advances']); ?></td>
													</tr>
													<tr>
														<td><?php _e("% OF NET NPAS TO NET LOANS","gsc-bank"); ?></td>
														<td><?php echo esc_html($previous_year['%_of_net_npas_to_net_loans']); ?></td>
														<td><?php echo esc_html($current_year['%_of_net_npas_to_net_loans']); ?></td>
													</tr>
													<tr>
														<td><?php _e("CAPITAL ADEQUACY RATIO (%)","gsc-bank"); ?></td>
														<td><?php echo esc_html($previous_year['capital_adequency_ratio']); ?></td>
														<td><?php echo esc_html($current_year['capital_adequency_ratio']); ?></td>
													</tr>
													<tr>
														<td><?php _e("NET WORTH","gsc-bank"); ?></td>
														<td><?php echo esc_html($previous_year['net_worth']); ?></td>
														<td><?php echo esc_html($current_year['net_worth']); ?></td>
													</tr>
												</tbody>
								            </table>
								        </div>
								    </div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div><?php

get_footer();