<?php
// This is a PLUGIN TEMPLATE.
// Copy this file to a new name like abc_myplugin.php.  Edit the code, then
// run this file at the command line to produce a plugin for distribution:
// $ php abc_myplugin.php > abc_myplugin-0.1.txt

// Plugin name is optional.  If unset, it will be extracted from the current
// file name. Uncomment and edit this line to override:
$plugin['name'] = 'sho_bluff';

// 0 = Plugin help is in Textile format, no raw HTML allowed (default).
// 1 = Plugin help is in raw HTML.  Not recommended.
# $plugin['allow_html_help'] = 1;

$plugin['version'] = '0.2';
$plugin['author'] = 'Stephan Hochhaus';
$plugin['author_uri'] = 'http://yauh.de';
$plugin['description'] = 'Simple chart integration using <a href="http://bluff.jcoglan.com/">Bluff</a>';

// Plugin load order:
// The default value of 5 would fit most plugins, while for instance comment spam evaluators or URL redirectors
// would probably want to run earlier (1...4) to prepare the environment for everything else that follows.
// Orders 6...9 should be considered for plugins which would work late. This order is user-overrideable.
$plugin['order'] = '5';

// Plugin 'type' defines where the plugin is loaded
// 0 = public       : only on the public side of the website (default)
// 1 = public+admin : on both the public and admin side
// 2 = library      : only when include_plugin() or require_plugin() is called
// 3 = admin        : only on the admin side
$plugin['type'] = '0';

if (!defined('txpinterface'))
        @include_once('zem_tpl.php');

# --- BEGIN PLUGIN CODE ---
	##################
	#
	#	sho_bluff for Textpattern
	#	version 0.2
	#	by Stephan Hochhaus
	#	http://yauh.de
	#
	###################

function sho_bluff($atts)
{
	extract(lAtts(array('canvas_id' => 'graph', 'width' => '300', 'height' => '225', 'table_id' => 'data', 'title' => '', 'chart_type' => 'StackedBar', 'use_themes' => '1', 'theme' => 'pastel', 'tooltips' => '0', 'custom_code' => ''),$atts));

	$out = '<script language="javascript" src="/js/bluff/js-class.js" type="text/javascript"></script><script language="javascript" src="/js/bluff/bluff-min.js" type="text/javascript"></script><script language="javascript" src="/js/bluff/excanvas.js" type="text/javascript"></script>';
	$out .= "  <canvas id=\"$canvas_id\" width=\"$width\" height=\"$height\"></canvas>";
	$out .= '<script type="text/javascript">';
	$out .= "   var g = new Bluff.$chart_type('$canvas_id', '" . $width . "x" . $height . "');";
	if ($title != '') {
	    $out .= "    g.title = '$title';";
	}
	if ($tooltips == "1") {
	    $out .= '    g.tooltips = true;';
	}
	$out .= "    $custom_code";
	if ($use_themes == "1") {
	    $out .= "    g.theme_" . $theme . "();";
	}
	$out .= "    g.data_from_table('$table_id');";
	$out .= '    g.draw();';
	$out .= '  </script>';
	return $out;
}

# --- END PLUGIN CODE ---
if (0) {
?>
<!--
# --- BEGIN PLUGIN HELP ---
<h1 class="title">sho_bluff for Textpattern</h1>

	<ol>
		<li><a href="#sho_bluff_disclaimer">Disclaimer</a></li>
		<li><a href="#sho_bluff_change_log">Change Log</a></li>
		<li><a href="#sho_bluff_installation">Installation / Uninstallation</a></li>
		<li><a href="#sho_bluff_tag">The sho_bluff tag</a></li>
		<li><a href="#sho_bluff_usage">Usage</a></li>
	</ol>

	<p><em>sho_bluff</em> sho_bluff is an easy way to add charts to your articles or site by using the <a href="http://bluff.jcoglan.com/">Bluff JavaScript library</a>. sho_bluff takes the data from an HTML table and draws a chart accordingly. The plug-in was written by <a href="http://yauh.de">Stephan Hochhaus</a>.<br />Bluff is a JavaScript port of <a href="http://nubyonrails.com/pages/gruff">Gruff for Ruby</a>. One way to use it is to take a semantically well-formed HTML table and create a chart based on it. Find more information on Bluff here: <a href="http://bluff.jcoglan.com/">http://bluff.jcoglan.com/</a></p>

	<p>Requirements:</p>

	<ul>
		<li>Textpattern 4.2+</li>
		<li>Bluff libraries v0.3.6+</li>
	</ul>

	<h2 class="section" id="sho_bluff_disclaimer">Disclaimer</h2>

	<p>This is my first attempt at creating a plug-in, so this is probably full of nasty bugs. I take no guarantees that it works and it's more a proof of concept than a working plug-in. If you decide to use it, do so on your own risk. You have been warned!</p>

	<p>The reason for creating this plug-in is to have a simple way to use charts with Textpattern. This method using Bluff is probably not the most powerful, but a very simple one suitable for many situations.</p>

	<h2 class="section" id="sho_bluff_change_log">Change Log</h2>

	<ul>
              <li>26-02-2010: v0.2 - bugfix (path to Bluff libraries was b0rked, now set to <em>/js/bluff/...</em>)</li>
              <li>25-02-2010: v0.1 - initial release</li>
       </ul>

	<h2 class="section" id="sho_bluff_installation">Installation / Uninstallation</h2>

	<p>In order to use the Bluff libraries you will have to copy them to your webhost. Please download the latest release from <a href="http://bluff.jcoglan.com/">http://bluff.jcoglan.com/</a> and put the <em>.js</em> files into a directory called <em>bluff</em> in your website root.<br />Actually you need the following files:</p>

	<ul>
		<li><code>/js/bluff/excanvas.js</code></li>
		<li><code>/js/bluff/bluff-min.js</code></li>
		<li><code>/js/bluff/js-class.js</code></li>
	</ul>

	<p>To install <em>sho_bluff</em> go to the &#8216;plugins&#8217; tab under &#8216;admin&#8217; and paste the plugin code into the &#8216;Install plugin&#8217; box, &#8216;upload&#8217; and then &#8216;install&#8217;. Finally activate the plugin.</p>

	<p><span class="tag">sho_bluff</span> should now be ready for use on the public-side of your site. Just add it to any article or form that contains a table with data you wish to visualize and you're good to go.</p>

	<p>In order to remove <span class="tag">sho_bluff</span> simply delete the plugin from the &#8216;Plugins&#8217; tab.  You can also remove the bluff directory inside your web root if you don't need it for any other reasons.</p>

	<h2 class="section" id="sho_bluff_tag">The sho_bluff tag</h2>

	<h3>Syntax</h3>

	<p>&lt;txp:sho_bluff chart_type=&quot;Line&quot; /&gt;</p>

	<h3>Usage</h3>

	<table>
		<tr>
			<th>Attribute</th>
			<th>Description</th>
			<th>Default</th>
			<th>Supported Values</th>
		</tr>
		<tr>
			<td>canvas_id</td>
			<td>ID of the canvas/chart area</td>
			<td><em>graph</em></td>
			<td>any desireable name/ID</td>
		</tr>
		<tr>
			<td>width</td>
			<td>Width of the chart area</td>
			<td><em>300</em></td>
			<td>any numerical value</td>
		</tr>
		<tr>
			<td>height</td>
			<td>Height of the chart area</td>
			<td> <em>225</em></td>
                        <td>any numerical value</td>
		</tr>
		<tr>
			<td>table_id</td>
			<td>ID of the table that contains the data for chart generation</td>
			<td><em>data</em></td>
			<td>id of a table on the same HTML site as the <em>sho_bluff</em> tag</td>
		</tr>
		<tr>
			<td>title</td>
			<td>Title for the chart (will be rendered inside the canvas)</td>
			<td><em>empty</em></td>
			<td>any alphanumerical value</td>
		</tr>
		<tr>
			<td>chart_type</td>
			<td>Type of chart (line, bar, etc.)</td>
			<td> <em>StackedBar</em></td>
			<td>AccumulatorBar, Area, Bar, Dot, Line, Mini.Bar, Mini.Pie, Mini.SideBar, Net, Pie, SideBar, SideStackedBar, Spider, StackedArea, StackedBar
</td>
		</tr>
		<tr>
			<td>use_themes</td>
			<td>indicates whether you want to use Bluff's predefined themes or provide you own styles by using custom code.<br /><strong>If set to 0 you will have to provide style code via <em>custom_code</em>!</strong></td>
			<td> <em>1</em></td>
			<td>0 or 1</td>
		</tr>
		<tr>
			<td>theme</td>
			<td>One of the predefined themes - if desired use <em>custom_code</em> to create your own theme</td>
			<td><em>pastel</em></td>
			<td>keynote,   37signals,   rails_keynote,   odeo,   pastel,   greyscale</td>
		</tr>
		<tr>
			<td>tooltips</td>
			<td>Adds tooltips to charts if the chosen type supports it</td>
			<td><em>0</em></td>
			<td>1 or 0</td>
		</tr>
		<tr>
			<td>custom_code</td>
			<td>A chance to add some custom code between the &lt;script&gt; tags</td>
			<td><em>empty</em></td>
			<td>virtually any valid JavaScript code, preferably some of the <a href="http://bluff.jcoglan.com/api.html">Bluff API options</a></td>
		</tr>
	</table>

	<h3>Example usage</h3>

	<p>&lt;txp:sho_bluff width=&quot;600&quot; height=&quot;300&quot; table_id=&quot;census2010&quot; chart_type=&quot;StackedArea&quot; theme=&quot;keynote&quot; /&gt;</p>

	<p>Results in a 600x300 chart based on a table with the ID <em>census2010</em> using the <em>keynote</em> theme and display data as stacked areas. Custom code is not used (by default).</p>

	<h2 class="section" id="sho_bluff_usage">Usage in an article</h2>

	<h3>Prerequisites</h3>

	<p>In order to use <em>sho_bluff</em> in an article you need a table with a unique ID and correctly set header cells (make good use of &lt;th&gt; or in textile: |_header cells_|) that will be rendered on the same HTML page as the contents of <em>&lt;txp:sho_bluff&gt;</em>. This could look like the following.</p>

	<h3>Example usage in articles using textile</h3>

	<p>This first example will output a simple table and the corresponding line chart.</p>

	<p><code>table(#data).<br />
|_&amp;nbsp;_|_Dataset A_|_Dataset B_|<br />
|_Jan_|10|12|<br />
|_Feb_|21|19|<br />
</code>
</p>

<p><code>&lt;txp:sho_bluff chart_type="Line" /&gt;</code></p>

	<p>This second example will not output a table (because of the <em>display:none</em> style but only a (StockedArea) chart. This could also be used in a sidebar outside the article context.</p>

	<p><code>table(#data){display:none}.<br />
|_&amp;nbsp;_|_Dataset A_|_Dataset B_|<br />
|_Jan_|10|12|<br />
|_Feb_|21|19|<br />
</code>
</p>

<p><code>&lt;txp:sho_bluff  /&gt;</code></p>

	<p>This third example is taken from my own site <a href="http://feierabendyogi.de">feierabendyogi.de</a>. For the time being you can see a chart documenting my progress in the <a href="http://feierabendyogi.de/surya-count/surya-count-2010">Surya Challenge 2010</a>.<br />The following code was used to achieve this chart:</p>

	<p><code>table(#suryadata){display:none}.<br />
|_&nbsp;_|_Surya A_|_Surya B_|<br />
|_Januar_|117|63|<br />
|_Februar_|91|67|<br />
</code>
</p>

<p><code>&lt;txp:sho_bluff table_id="suryadata" chart_type="StackedBar" theme="pastel" width="400" height="200" tooltips="1"  /&gt;</code></p>
# --- END PLUGIN HELP ---
-->
<?php
}
?>