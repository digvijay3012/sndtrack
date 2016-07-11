 <?php
$ArtistData	=	$this->ion_auth->user()->row();
if(!empty($ArtistData)){
	$artistID 		=		$ArtistData->user_id;
	$artistEmail 	=		$ArtistData->email;
	$first_name 	=		$ArtistData->first_name;
	$last_name 		=		$ArtistData->last_name;
}
?>
 <div class="dashboard_cont sales_mn">
        <div class="container">
            <div class="welcom_strip tex-center">
                <h2 class="pull-left"><?php echo $first_name." ".$last_name; ?></h2>
                <h2 class="text-center">Sales</h3>
            </div>
            <div class="date_range_col">
                    <div class="sales_songs_cnt text-center">
                            <!--h2>Web Traffic</h2-->
                <div class="date_range h2_hiidn">
                    <h3>Date Range:</h3>
                    <select>
                        <option>Apr 2016</option>
                        <option>Apr 2016</option>
                        <option>Apr 2016</option>
                    </select>
                    <p>to</p>
                    <select>
                        <option>Aug 2016</option>
                        <option>Aug 2016</option>
                        <option>Aug 2016</option>
                    </select>
                </div>
                <div class="chcbox_sales">
                    <input type="checkbox" class="css-checkbox" id="input7">
                    <label class="css-label lite-blue-check" for="input7"></label>
                </div>
            </div>
            <div class="graph"><img src="<?php echo base_url(); ?>images/graph.jpg" alt="" /></div>
        </div>
        <div class="date_range_table">
            <h2>Sales</h2>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th colspan="2" class="nme_user">Track</th>
                                <th>Release Date</th>
                                <th>Personal sales</th>
                                <th>Lite sales</th>
                                <th>standard sales </th>
                                <th>Premium Sales</th>
                                <th>Other Sales</th>
                                <th>Total Sales</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="input_chckbox">

                                </td>
                                <td class="nme_user">Clem Snide
                                    <p>Route 66</p>
                                </td>
                                <td>21 January 2016</td>
                                <td>232</td>
                                <td>1,188</td>
                                <td>894</td>
                                <td>2451</td>
                                <td>88</td>
                                <td>4888</td>
                            </tr>
                            <tr>
                                <td class="input_chckbox table_padding width_input">
                                    <input type="checkbox" class="css-checkbox" id="input2">
                                    <label class="css-label lite-blue-check" for="input2"></label>
                                </td>
                                <td class="nme_user">Clem Snide
                                    <p>Route 66</p>
                                </td>
                                <td>22 January 2016</td>
                                <td>232</td>
                                <td>1,188</td>
                                <td>894</td>
                                <td>2451</td>
                                <td>88</td>
                                <td>4888</td>
                            </tr>
                            <tr>
                                <td class="input_chckbox table_padding width_input">
                                    <input type="checkbox" class="css-checkbox" id="input3">
                                    <label class="css-label lite-blue-check" for="input3"></label>
                                </td>
                                <td class="nme_user">Clem Snide
                                    <p>Route 66</p>
                                </td>
                                <td>23 January 2016</td>
                                <td>232</td>
                                <td>1,188</td>
                                <td>894</td>
                                <td>2451</td>
                                <td>88</td>
                                <td>4888</td>
                            </tr>
                            <tr>
                                <td class="input_chckbox table_padding width_input">
                                    <input type="checkbox" class="css-checkbox" id="input4">
                                    <label class="css-label lite-blue-check" for="input4"></label>
                                </td>
                                <td class="nme_user">Clem Snide
                                    <p>Route 66</p>
                                </td>
                                <td>24 January 2016</td>
                                <td>232</td>
                                <td>1,188</td>
                                <td>894</td>
                                <td>2451</td>
                                <td>88</td>
                                <td>4888</td>
                            </tr>
                            <tr>
                                <td class="input_chckbox table_padding width_input">
                                    <input type="checkbox" class="css-checkbox" id="input5">
                                    <label class="css-label lite-blue-check" for="input5"></label>
                                </td>
                                <td class="nme_user">Clem Snide
                                    <p>Route 66</p>
                                </td>
                                <td>21 January 2016</td>
                                <td>232</td>
                                <td>1,188</td>
                                <td>894</td>
                                <td>2451</td>
                                <td>88</td>
                                <td>4888</td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="table total">
                        <tbody>
                            <tr>
                                <td>Total</td>
                                <td>12980</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
 
