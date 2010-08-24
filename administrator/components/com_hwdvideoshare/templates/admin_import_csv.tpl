{* 
//////
//    @version [ Dannevirke ]
//    @package hwdVideoShare
//    @copyright (C) 2007 - 2009 Highwood Design
//    @license http://creativecommons.org/licenses/by-nc-nd/3.0/
//////
*}

<div style="text-align:left;padding:5px;margin:5px;border:1px solid #ccc;background:#f5f5ee;">
  <h3>{$smarty.const._HWDVIDS_IMPT_CSV_TITLE}</h3>
  {$smarty.const._HWDVIDS_DOCS}: <a href="http://documentation.hwdmediashare.co.uk/wiki/Import_Videos_from_SQL_Backup_File" target="_blank">http://documentation.hwdmediashare.co.uk/wiki/Import_Videos_from_SQL_Backup_File</a>
  <p>{$smarty.const._HWDVIDS_IMPT_CSV_DESC}</p>
</div>

<div style="border:1px solid #c30;color:#333333;background:#e9ddd9;font-weight: bold;text-align:left;padding:5px;margin:5px;">{$smarty.const._HWDVIDS_IMPT_CSV_WARN}</div>

<div style="text-align:left;padding:5px;margin:5px;border:1px solid #ccc;">
<form action="index.php" method="post" enctype="multipart/form-data">

	<table cellpadding="4" cellspacing="1" border="0">
	  <!--<tr>
	    <td valign="top">{$smarty.const._HWDVIDS_IMPT_MT}</td>
	    <td valign="top">
	      <select name="mediatype">
		<option value ="flv">Only FLV Videos</option>
		<option value ="mixed">Videos in Different Formats</option>
	      </select>    
	    </td>
	  </tr>-->
	  <tr>
	    <td valign="top">{$smarty.const._HWDVIDS_IMPT_CSV_DL}</td>
	    <td valign="top">
	      <select name="delimiter">
		<option value ="comma">Comma</option>
		<option value ="tab">Tab</option>
		<option value ="pipe">Pipe</option>
	      </select>
	    </td>
	  </tr>
	  <tr>
	    <td valign="top">{$smarty.const._HWDVIDS_IMPT_CSV_ME}</td>
	    <td valign="top">
	      <select name="maxerrors">
		<option value="1">1</option>
		<option value="2">2</option>
		<option value="3">3</option>
		<option value="4">4</option>
		<option value="5">5</option>
		<option value="6">6</option>
		<option value="7">7</option>
		<option value="8">8</option>
		<option value="9">9</option>
		<option value="10">10</option>
		<option value="11">11</option>
		<option value="12">12</option>
		<option value="13">13</option>
		<option value="14">14</option>
		<option value="15">15</option>
		<option value="16">16</option>
		<option value="17">17</option>
		<option value="18">18</option>
		<option value="19">19</option>
		<option value="20">20</option>
		<option value="21">21</option>
		<option value="22">22</option>
		<option value="23">23</option>
		<option value="24">24</option>
		<option value="25">25</option>
		<option value="26">26</option>
		<option value="27">27</option>
		<option value="28">28</option>
		<option value="29">29</option>
		<option value="30">30</option>
		<option value="31">31</option>
		<option value="32">32</option>
		<option value="33">33</option>
		<option value="34">34</option>
		<option value="35">35</option>
		<option value="36">36</option>
		<option value="37">37</option>
		<option value="38">38</option>
		<option value="39">39</option>
		<option value="40">40</option>
		<option value="41">41</option>
		<option value="42">42</option>
		<option value="43">43</option>
		<option value="44">44</option>
		<option value="45">45</option>
		<option value="46">46</option>
		<option value="47">47</option>
		<option value="48">48</option>
		<option value="49">49</option>
		<option value="50">50</option>
		<option value="51">51</option>
		<option value="52">52</option>
		<option value="53">53</option>
		<option value="54">54</option>
		<option value="55">55</option>
		<option value="56">56</option>
		<option value="57">57</option>
		<option value="58">58</option>
		<option value="59">59</option>
		<option value="60">60</option>
		<option value="61">61</option>
		<option value="62">62</option>
		<option value="63">63</option>
		<option value="64">64</option>
		<option value="65">65</option>
		<option value="66">66</option>
		<option value="67">67</option>
		<option value="68">68</option>
		<option value="69">69</option>
		<option value="70">70</option>
		<option value="71">71</option>
		<option value="72">72</option>
		<option value="73">73</option>
		<option value="74">74</option>
		<option value="75">75</option>
		<option value="76">76</option>
		<option value="77">77</option>
		<option value="78">78</option>
		<option value="79">79</option>
		<option value="80">80</option>
		<option value="81">81</option>
		<option value="82">82</option>
		<option value="83">83</option>
		<option value="84">84</option>
		<option value="85">85</option>
		<option value="86">86</option>
		<option value="87">87</option>
		<option value="88">88</option>
		<option value="89">89</option>
		<option value="90">90</option>
		<option value="91">91</option>
		<option value="92">92</option>
		<option value="93">93</option>
		<option value="94">94</option>
		<option value="95">95</option>
		<option value="96">96</option>
		<option value="97">97</option>
		<option value="98">98</option>
		<option value="99">99</option>
		<option value="100">100</option>
	      </select>
	    </td>
	  </tr>
	</table>

<input type="file" name="upfile_0" value="" size="30">
<input type="submit" value="{$smarty.const._HWDVIDS_BUTTON_UPLOAD}">
<input type="hidden" name="option" value="com_hwdvideoshare" />
<input type="hidden" name="task" value="csvImport" />
<input type="hidden" name="hidemainmenu" value="0">
</form>
</div>
