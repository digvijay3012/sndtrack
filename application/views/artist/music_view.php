<?php
error_reporting(0);
require_once('getid3/getid3.php');
$ArtistData	=	$this->ion_auth->user()->row();
if(!empty($ArtistData)){
	$artistID 		=		$ArtistData->user_id;
	$artistEmail 	=		$ArtistData->email;
	$first_name 	=		$ArtistData->first_name;
	$last_name 		=		$ArtistData->last_name;
}
?>
<div class="dashboard_cont">
        <div class="container">
            <div class="welcom_strip tex-center">
                <h2 class="pull-left"><?php echo $first_name." ".$last_name; ?></h2>
                <h2 class="text-center">Your Music</h2>
            </div>
            <div class="artist_draft_cont">
                <ul class="nav nav-tabs">

                    <li class="active"><a data-toggle="tab" href="#mnu1">Songs</a></li>
                    <!--<li><a data-toggle="tab" href="#mnu2">Albums</a></li>-->
                </ul>
                <h2 class=" artst_drft_table">Track</h2>
                <div class="tab-content">

                    <div id="mnu1" class="tab-pane fade in active">
                        <div class="table-responsive">
                            <table id="example" class="table">
                                <tbody>
								<?php if(!empty($data['single_track'])){
									$trackCounter='';
									foreach($data['single_track'] as $getSingleTrackData){
										 $trackId			=	$getSingleTrackData['id'];	
										 $GettrackName		=	explode(".", $getSingleTrackData['watermark_format']);
										 $trackName			=	$GettrackName['0'];
										
										 $songUploadDate	=	$getSingleTrackData['song_upload_date'];
										 $modifyDate		= 	strtotime($songUploadDate);
										 $songPublishDate	=  date('j F  Y', $modifyDate);
										 $mp3Filename		=	$getSingleTrackData['watermark_format'];
										 $trackImage		=	$getSingleTrackData['track_image'];
										 $originalFile		=	$getSingleTrackData['premium_licence'];
											$path = getcwd();
											$getID3 = new getID3;
											$time_start = microtime(true);
											$remotefileurl = "music/".$mp3Filename;;
											$fp = fopen($remotefileurl, 'rb');
											if ($fp2 = fopen('sample', 'wb')) {
												$kkb = fread($fp, 32 * 1024 * 1024);
												fwrite($fp2, $kkb);
											}
											fclose($fp);
											$head    = array_change_key_case(get_headers($remotefileurl, TRUE));
											$bits    = $head['content-length'] * 8;
											$meta    = $getID3->analyze('sample');
										/*  echo "<pre>";
											print_r($meta);
											echo "</pre>"; */  
											$bitrate 		= 	$meta['audio']['bitrate'];
											$duration 		= 	$bits / $bitrate;
											$playTime 		=	$meta['playtime_string'];
											$MusicFileSize 	=	$meta['filesize']/1024;
											$estimate 		=	round($MusicFileSize)/1000;
											$mbSize 		= (float)number_format($estimate, 2, '.', '');
											$time_end = microtime(true);
											$exectime = (number_format((float) ($time_end - $time_start), 2, '.', ''));
											$trackCounter++;
										 ?>
										 <tr>
											<td class="input_chckbox table_padding width_input">
												
												<div class="play" id="btn<?php echo $trackCounter; ?>"><img src="<?php echo base_url(); ?>images/play.png" alt=""></div>
											</td>
											<td class="width_tittle nme_user"><?php echo $trackName; ?></td>
											<td><?php echo $songPublishDate; ?></td>
											<td><?php echo $playTime; ?></td>
											<td><?php echo $mbSize; ?>MB</td>
											<td class="lst_data">
												<a href="<?php echo base_url()."music/".$originalFile?>" download>Download Original</a>
											</td>
											<audio id="sound<?php echo $trackCounter; ?>">
												<source src="<?php echo base_url()."music/".$mp3Filename?>" type="audio/mp3" />
											</audio>
										</tr>
									<?php } }else{
										echo "No data to display.";
									}
								?>
                                    
                                   
                                </tbody>
                            </table>
                        </div>
                    </div>
					
                    <div id="mnu2" class="tab-pane fade">
					<?php 
					
					if(!empty($data['album'])){
						foreach($data['album'] as $getAlbumData){
								$AlbumID			=	$getAlbumData['album_id'];
								$album_name			=	$getAlbumData['album_name'];
								$album_image		=	$getAlbumData['album_image'];
								$album_date			=	$getAlbumData['album_date'];
								$modifyDate			= 	strtotime($album_date);
								$albumPublishDate	=  date('j F  Y', $modifyDate);
							if($album_image==''){
								$albumImageUrl	=	base_url()."images/No_image.png";
							}else{
								$albumImageUrl	=	base_url()."music_images/".$album_image;
							}
						?>
                        <div class="album_info pull-left col-sm-6 col-xs-12 pdngg-right">
                            <div class="albu_image">
                                <img src="<?php echo $albumImageUrl; ?>" alt="">
                            </div>
                            <div class="album_nam">
                                <ul>
                                    <li>Album Name:</li>
                                    <li><?php echo $album_name; ?></li>
                                </ul>
                                <ul>
                                    <li>Release Date:</li>
                                    <li><?php echo $albumPublishDate; ?> </li>
                                </ul>
                            </div>
                        </div>
                        <div class="pull-right album_playlist col-sm-6 col-xs-12 pdngg-left">
                            <div class="table-responsive">
                                <table class="table">
                                    <tbody>
									<?php 
										$getTracks	=	get_album_tracks($AlbumID);
										$albumtrackCounter='';
										if(!empty($getTracks)){
											foreach($getTracks as $getTracksData){
											 $albumTrackId			=	$getTracksData['id'];	
											 $albumTrackName		=	$getTracksData['song_name'];
											 $albummp3Filename		=	$getTracksData['mp3_filename'];
											$path = getcwd();
											$getID3 = new getID3;
											$time_start = microtime(true);
											$remotefileurl = "music/".$albummp3Filename;;
											$fp = fopen($remotefileurl, 'rb');
											if ($fp2 = fopen('sample', 'wb')) {
												$kkb = fread($fp, 32 * 1024 * 1024);
												fwrite($fp2, $kkb);
											}
											fclose($fp);
											$head    = array_change_key_case(get_headers($remotefileurl, TRUE));
											$bits    = $head['content-length'] * 8;
											$meta    = $getID3->analyze('sample');
										/*  echo "<pre>";
											print_r($meta);
											echo "</pre>"; */  
											$bitrate 		= 	$meta['audio']['bitrate'];
											$duration 		= 	$bits / $bitrate;
											$playTime 		=	$meta['playtime_string'];
											$MusicFileSize 	=	$meta['filesize']/1024;
											$estimate 		=	round($MusicFileSize)/1000;
											$mbSize 		= (float)number_format($estimate, 2, '.', '');
											$time_end = microtime(true);
											$exectime = (number_format((float) ($time_end - $time_start), 2, '.', ''));
											$albumtrackCounter++;
										?>
                                        <tr class="border_table">
                                            <td class="input_chckbox table_padding width_input">
                                                <div class="play" id="btn<?php echo $albumtrackCounter; ?>"><img src="<?php echo base_url(); ?>images/play.png" alt=""></div>
												
                                            </td>
                                            <td class="text-rt"><?php echo $albumTrackName; ?></td>
                                            <td class="rt_txt"><?php echo $playTime; ?></td>
                                        </tr>
										<?php } } else{ echo '<tr><td></td><td>No data to display.</td><td></td></tr>'; } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
					<?php } } else{ 
						echo "No data to display.";
					} ?>
                    </div>
                </div>
            </div>
        </div>
    </div>


<script>
$('.play').click(function(){
    var $this = $(this);
    var id = $this.attr('id').replace(/btn/, '');
    $this.toggleClass('active');
    if($this.hasClass('active')){
		
        $this.html('pause'); 
        $('audio[id^="sound"]')[id-1].play();        
    } else {
        $this.html('<img alt="" src="<?php echo base_url(); ?>images/play.png">');
        $('audio[id^="sound"]')[id-1].pause();
    }
});
</script>
	<script type="text/javascript" src="//code.jquery.com/jquery-1.12.3.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
<script>
//sweetAlert('Oops...', 'Maximum file size exceeds.', 'error');
</script>