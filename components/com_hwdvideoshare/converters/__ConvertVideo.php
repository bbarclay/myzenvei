<?php
/**
 *    @version 2.1.2 Build 21201 Alpha [ Linkwater ]
 *    @package hwdVideoShare
 *    @copyright (C) 2007 - 2009 Highwood Design
 *    @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
 ***
 *    This program is free software: you can redistribute it and/or modify
 *    it under the terms of the GNU General Public License as published by
 *    the Free Software Foundation, either version 3 of the License, or
 *    (at your option) any later version.
 *
 *    This program is distributed in the hope that it will be useful,
 *    but WITHOUT ANY WARRANTY; without even the implied warranty of
 *    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *    GNU General Public License for more details.
 *
 *    You should have received a copy of the GNU General Public License
 *    along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

/**
 * @package    hwdVideoShare
 * @author     Dave Horsfall <info@highwooddesign.co.uk>
 * @copyright  2008 Highwood Design
 * @license    http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * @version    1.1.3
 */
class hwd_vs_ConvertVideo
{
    /**
     * CONVERT VIDEOS TO FLV FORMAT
     * @param database A database connector object
     */
	function convert($path_original, $path_new_flv, $filename_ext, $path_new_mp4, $gen_flv=1, $gen_mp4=1) {

		defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);
		defined('CONVERTPATH') ? null : define('CONVERTPATH', dirname(__FILE__));

		if(substr(PHP_OS, 0, 3) == "WIN") {

			defined('JPATH_SITE') ? null : define('JPATH_SITE', str_replace("\components\com_hwdvideoshare\converters", "", CONVERTPATH) );

		} else {

			defined('JPATH_SITE') ? null : define('JPATH_SITE', str_replace("/components/com_hwdvideoshare/converters", "", CONVERTPATH) );

		}

		// get joomla configuration
		include_once(JPATH_SITE.DS.'configuration.php');

		// get hwdVideoShare general settings
		include_once(JPATH_SITE.DS.'administrator'.DS.'components'.DS.'com_hwdvideoshare'.DS.'config.hwdvideoshare.php');
		$c = hwd_vs_Config::get_instance();

		// get hwdVideoShare server settings
		include_once(JPATH_SITE.DS.'administrator'.DS.'components'.DS.'com_hwdvideoshare'.DS.'serverconfig.hwdvideoshare.php');
		$s = hwd_vs_SConfig::get_instance();

		$wmvfix = null;
		//if ($filename_ext == "wmv") {
			if ($c->applywmvfix == "1") {
				$wmvfix = ",harddup -ofps 25";
			}
		//}

		// shared library
		$sharedlib = null;
		if ($c->sharedlibrarypath !== "") {
			$sharedlib = "export LD_LIBRARY_PATH=$c->sharedlibrarypath;";
		}

		$c->cnvt_fsize = str_replace("x", ":", $c->cnvt_fsize);
        $c->customencode = stripslashes($c->customencode);

		if(substr(PHP_OS, 0, 3) == "WIN") {

			$path_original = '"'.$path_original.'"';
			$path_new_flv  = '"'.$path_new_flv.'"';
			$path_new_mp4  = '"'.$path_new_mp4.'"';

		}

		if ($gen_flv == 1) {
			if ($c->encoder == "MENCODER") {

				if(!file_exists($path_new_flv) || (filesize($path_new_flv) == 0)){
					$cmd_input_flv = "$s->mencoderpath $path_original -o $path_new_flv -of lavf -oac mp3lame -lameopts abr:br=$c->cnvt_abitrate -ovc lavc -lavcopts vcodec=flv:vbitrate=$c->cnvt_vbitrate:mbd=2:mv0:trell:v4mv:cbp:last_pred=3 -vf scale=$c->cnvt_fsize$wmvfix -srate $c->cnvt_asr $c->customencode";
					@exec("$sharedlib $cmd_input_flv 2>&1", $cmd_output_flv);
				}

				if(!file_exists($path_new_flv) || (filesize($path_new_flv) == 0)){
					$cmd_input_flv = "$s->mencoderpath $path_original -o $path_new_flv -of lavf -oac mp3lame -lameopts abr:br=$c->cnvt_abitrate -ovc lavc -lavcopts vcodec=flv:vbitrate=$c->cnvt_vbitrate:mbd=2:mv0:trell:v4mv:cbp:last_pred=3 -lavfopts i_certify_that_my_video_stream_does_not_use_b_frames -vf scale=$c->cnvt_fsize$wmvfix -srate $c->cnvt_asr $c->customencode";
					@exec("$sharedlib $cmd_input_flv 2>&1", $cmd_output_flv);
				}

			} else if ($c->encoder == "FFMPEG") {

				$cmd_input_flv = "$s->ffmpegpath -y -i $path_original -ab $c->cnvt_abitrate*1000 -ar $c->cnvt_asr -b $c->cnvt_vbitrate*1000 -s $c->cnvt_fsize $c->customencode $path_new_flv";
				@exec("$sharedlib $cmd_input_flv 2>&1", $cmd_output_flv);

			}
		} else {
			$cmd_input_flv = '';
			$cmd_output_flv = '';
		}

		if ($gen_mp4 == 1 && $c->uselibx264 == 1) {

			$cmd_input_mp4 = "$s->ffmpegpath -y -chromaoffset 0 -i $path_original -an -pass 1 -s 640x480 -vcodec libx264 -b 768K -flags +loop -cmp +chroma -partitions 0 -me_method epzs -subq 1 -trellis 0 -refs 1 -coder 0 -me_range 16 -g 300 -keyint_min 25 -sc_threshold 40 -i_qfactor 0.71 -bt 768K -maxrate 1.5M -bufsize 10M -rc_eq 'blurCplx^(1-qComp)' -qcomp 0.6 -qmin 10 -qmax 51 -qdiff 4 -level 30 -aspect 1:1 $path_new_mp4";
			@exec("$sharedlib $cmd_input_mp4 2>&1", $cmd_output_mp4_p1);

			$cmd_input_mp4 = "$s->ffmpegpath -y -chromaoffset 0 -i $path_original -acodec libfaac -ab 128k -pass 2 -s 640x480 -vcodec libx264 -b 768K -flags +loop -cmp +chroma -partitions +parti4x4+partp8x8+partb8x8 -me_method umh -subq 5 -trellis 1 -refs 1 -coder 0 -me_range 16 -g 300 -keyint_min 25 -sc_threshold 40 -i_qfactor 0.71 -bt 768K -maxrate 1.5M -bufsize 10M -rc_eq 'blurCplx^(1-qComp)' -qcomp 0.6 -qmin 10 -qmax 51 -qdiff 4 -level 30 -aspect 16:9 $path_new_mp4";
			@exec("$sharedlib $cmd_input_mp4 2>&1", $cmd_output_mp4_p2);

			$cmd_output_mp4 = array_merge((array)$cmd_output_mp4_p1, (array)$cmd_output_mp4_p2);

			$cmd_faststart_output = '';
			if (file_exists($path_new_mp4)) {
				$cmd_faststart_output = hwd_vs_MoovAtom::move($path_new_mp4);
			}

		} else {
			$cmd_input_mp4 = '';
			$cmd_output_mp4 = '';
		}

		$result = array();
		$result[0] = 0;                         // result of flv conversion [0 = fail, 1 = fail, 2 = success]
		$result[1] = 0;                         // result of mp4 conversion [0 = fail, 1 = fail, 2 = success]
		$result[2] = $cmd_input_flv;            // input of flv conversion
		$result[3] = $cmd_output_flv;           // output of flv conversion
		$result[4] = $cmd_input_mp4;            // input of mp4 conversion
		$result[5] = $cmd_output_mp4;           // output of mp4 conversion
		$result[6] = '';                        // holder for output text
		$result[7] = $cmd_faststart_output;     // holder for output text

		if(substr(PHP_OS, 0, 3) == "WIN") {

			$path_original = str_replace('"', '', $path_original);;
			$path_new_flv  = str_replace('"', '', $path_new_flv);;
			$path_new_mp4  = str_replace('"', '', $path_new_mp4);;

		}

		list($filename_noext, $filename_ext) = @split('\.', basename($path_new_flv));
		$path_new_flv  = JPATH_SITE.DS.'hwdvideos'.DS.'uploads'.DS.$filename_noext.'.flv';

		if(!file_exists($path_new_flv)){

			$result[0] = 0;

		} else if(filesize($path_new_flv) == 0){

			$result[0] = 1;

		} else if(file_exists($path_new_flv) && (filesize($path_new_flv) > 0)){

			$result[0] = 2;

		}

		if(!file_exists($path_new_mp4)){

			$result[1] = 0;

		} else if(filesize($path_new_mp4) == 0){

			$result[1] = 1;

		} else if(file_exists($path_new_mp4) && (filesize($path_new_mp4) > 0)){

			$result[1] = 2;

		}

		$result = hwd_vs_ConvertVideo::generateOutput($result, $gen_flv, $gen_mp4);
		return $result;

	}
    /**
     * CONVERT VIDEOS TO FLV FORMAT
     * @param database A database connector object
     */
	function generateOutput($result, $gen_flv, $gen_mp4) {

		$c          = hwd_vs_Config::get_instance();
		$output     = '';

		if ($gen_flv == 1) {
			$output.= "<div class=\"box\"><div><h2>Converting FLV Video</h2></div>";
			if ($result[0] == 0) {
				$output.= "<div class=\"error\">ERROR: Problem with ".$c->encoder." - No Videos converted.</div>";
			} else if ($result[0] == 1) {
				$output.= "<div class=\"error\">ERROR: Problem with ".$c->encoder." - Output video has zero filesize.</div>";
			} else if ($result[0] == 2) {
				$output.= "<div class=\"success\">SUCCESS: FLV File Created</div>";
			}

			$output.= "<div><b>".$c->encoder." INPUT</b></div>
				  <div><textarea rows=\"3\" cols=\"50\" style=\"width:90%\">".$result[2]."</textarea></div>
				  <div><b>".$c->encoder." OUTPUT</b></div>
				  <div><textarea rows=\"3\" cols=\"50\" style=\"width:90%\">".hwd_vs_ConverterTools::processOutput($result[3])."</textarea></div>";
			$output.= "</textarea></div></div>";
		}

		if ($gen_mp4 == 1) {
			$output.= "<div class=\"box\"><div><h2>Converting MP4 Video</h2></div>";
			if ($result[1] == 0) {
				$output.= "<div class=\"error\">ERROR: Problem with ".$c->encoder." - No Videos converted.</div>";
			} else if ($result[1] == 1) {
				$output.= "<div class=\"error\">ERROR: Problem with ".$c->encoder." - Output video has zero filesize.</div>";
			} else if ($result[1] == 2) {
				$output.= "<div class=\"success\">SUCCESS: MP4 File Created</div>";
			}

			$output.= "<div><b>".$c->encoder." INPUT</b></div>
				  <div><textarea rows=\"3\" cols=\"50\" style=\"width:90%\">".$result[4]."</textarea></div>
				  <div><b>".$c->encoder." OUTPUT</b></div>
				  <div><textarea rows=\"3\" cols=\"50\" style=\"width:90%\">".hwd_vs_ConverterTools::processOutput($result[5])."</textarea></div>";
			$output.= "</textarea></div></div>";
		}

		$output.= $result[7][3];

		$result[6] = $output;
		return $result;

	}
}
?>