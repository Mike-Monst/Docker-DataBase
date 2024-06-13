<!---
This page contains Javascript that generates the HTML for displaying the
sample charts on the right frame. To view the HTML, please right click on
an empty position on the right frame, and select "View Source" (for IE) or
"This Frame -> View Frame Source" (for FireFox).
--->
<html>
<head>
<script language="Javascript">
var charts = [
    ['', "Pie Charts"],
    ['simplepie.php', "Simple Pie Chart", 1],
    ['threedpie.php', "3D Pie Chart", 1],
    ['multidepthpie.php', "Multi-Depth Pie Chart", 1],
    ['sidelabelpie.php', "Side Label Layout", 1],
    ['circlelabelpie.php', "Circular Label Layout", 2],
    ['legendpie.php', "Pie Chart with Legend (1)", 1],
    ['legendpie2.php', "Pie Chart with Legend (2)", 1],
    ['explodedpie.php', "Exploded Pie Chart", 1],
    ['iconpie.php', "Icon Pie Chart (1)", 1],
    ['iconpie2.php', "Icon Pie Chart (2)", 1],
    ['multipie.php', "Multi-Pie Chart", 3],
    ['donut.php', "Donut Chart", 1],
    ['threeddonut.php', "3D Donut Chart", 1],
    ['icondonut.php', "Icon Donut Chart", 1],
    ['texturedonut.php', "Texture Donut Chart", 1],
    ['concentric.php', "Concentric Donut Chart", 1],
    ['pieshading.php', "2D Pie Shading", 6],
    ['threedpieshading.php', "3D Pie Shading", 7],
    ['donutshading.php', "2D Donut Shading", 7],
    ['threeddonutshading.php', "3D Donut Shading", 8],
    ['fontpie.php', "Text Style and Colors", 1],
    ['threedanglepie.php', "3D Angle", 7],
    ['threeddepthpie.php', "3D Depth", 5],
    ['shadowpie.php', "3D Shadow Mode", 4],
    ['anglepie.php', "Start Angle and Direction", 2],
    ['donutwidth.php', "Donut Width", 5],
    ['', ""],
    ['', "Bar Charts"],
    ['simplebar.php', "Simple Bar Chart", 1],
    ['colorbar.php', "Multi-Color Bar Chart", 1],
    ['softlightbar.php', "Soft Bar Shading", 1],
    ['glasslightbar.php', "Glass Bar Shading", 1],
    ['gradientbar.php', "Gradient Bar Shading", 1],
    ['cylinderlightbar.php', "Cylinder Bar Shading", 1],
    ['threedbar.php', "3D Bar Chart", 1],
    ['cylinderbar.php', "Cylinder Bar Shape", 1],
    ['polygonbar.php', "Polygon Bar Shapes", 1],
    ['stackedbar.php', "Stacked Bar Chart", 1],
    ['percentbar.php', "Percentage Bar Chart", 1],
    ['multibar.php', "Multi-Bar Chart", 1],
    ['softmultibar.php', "Soft Multi-Bar Chart", 1],
    ['glassmultibar.php', "Glass Multi-Bar Chart", 1],
    ['gradientmultibar.php', "Gradient Multi-Bar Chart", 1],
    ['multicylinder.php', "Multi-Cylinder Chart", 1],
    ['multishapebar.php', "Multi-Shape Bar Chart", 1],
    ['overlapbar.php', "Overlapping Bar Chart", 1],
    ['multistackbar.php', "Multi-Stacked Bar Chart", 1],
    ['depthbar.php', "Depth Bar Chart", 1],
    ['posnegbar.php', "Positive Negative Bars", 1],
    ['hbar.php', "Borderless Bar Chart", 1],
    ['dualhbar.php', "Dual Horizontal Bar Charts", 1],
    ['markbar.php', "Bars with Marks", 1],
    ['pareto.php', "Pareto Chart", 1],
    ['varwidthbar.php', "Variable Width Bar Chart", 1],
    ['gapbar.php', "Bar Gap", 6],
    ['', ""],
    ['', "Line Charts"],
    ['simpleline.php', "Simple Line Chart", 1],
    ['compactline.php', "Compact Line Chart", 1],
    ['threedline.php', "3D Line Chart", 1],
    ['multiline.php', "Multi-Line Chart", 1],
    ['symbolline.php', "Symbol Line Chart (1)", 1],
    ['symbolline2.php', "Symbol Line Chart (2)", 1],
    ['missingpoints.php', "Missing Data Points", 1],
    ['unevenpoints.php', "Uneven Data Points ", 1],
    ['splineline.php', "Spline Line Chart", 1],
    ['stepline.php', "Step Line Chart", 1],
    ['linefill.php', "Inter-Line Coloring", 1],
    ['linecompare.php', "Line with Target Zone", 1],
    ['errline.php', "Line with Error Symbols", 1],
    ['multisymbolline.php', "Multi-Symbol Line Chart", 1],
    ['binaryseries.php', "Binary Data Series", 1],
    ['customsymbolline.php', "Custom Symbols", 1],
    ['rotatedline.php', "Rotated Line Chart", 1],
    ['xyline.php', "Arbitrary XY Line Chart", 1],
    ['', ""],
    ['', "Trending and Curve Fitting"],
    ['trendline.php', "Trend Line Chart", 1],
    ['scattertrend.php', "Scatter Trend Chart", 1],
    ['confidenceband.php', "Confidence Band", 1],
    ['paramcurve.php', "Parametric Curve Fitting", 1],
    ['curvefitting.php', "General Curve Fitting", 1],
    ['', ""],
    ['', "Scatter/Bubble/Vector Charts"],
    ['scatter.php', "Scatter Chart", 1],
    ['builtinsymbols.php', "Built-in Symbols", 1],
    ['scattersymbols.php', "Custom Scatter Symbols", 1],
    ['scatterlabels.php', "Custom Scatter Labels", 1],
    ['bubble.php', "Bubble Chart", 1],
    ['threedbubble.php', "3D Bubble Chart (1)", 1],
    ['threedbubble2.php', "3D Bubble Chart (2)", 1],
    ['threedbubble3.php', "3D Bubble Chart (3)", 1],
    ['bubblescale.php', "Bubble XY Scaling", 1],
    ['vector.php', "Vector Chart", 1],
    ['', ""],
    ['', "Area Charts"],
    ['simplearea.php', "Simple Area Chart", 1],
    ['enhancedarea.php', "Enhanced Area Chart", 1],
    ['threedarea.php', "3D Area Chart", 1],
    ['patternarea.php', "Pattern Area Chart", 1],
    ['stackedarea.php', "Stacked Area Chart", 1],
    ['threedstackarea.php', "3D Stacked Area Chart", 1],
    ['percentarea.php', "Percentage Area Chart", 1],
    ['deptharea.php', "Depth Area Chart", 1],
    ['rotatedarea.php', "Rotated Area Chart", 1],
    ['', ""],
    ['', "Floating Box/Waterfall Charts"],
    ['boxwhisker.php', "Box-Whisker Chart", 1],
    ['boxwhisker2.php', "Horizontal Box-Whisker Chart", 1],
    ['floatingbox.php', "Floating Box Chart", 1],
    ['waterfall.php', "Waterfall Chart", 1],
    ['posnegwaterfall.php', "Pos/Neg Waterfall Chart", 1],
    ['', ""],
    ['', "Gantt Charts"],
    ['gantt.php', "Simple Gantt Chart", 1],
    ['colorgantt.php', "Multi-Color Gantt Chart", 1],
    ['layergantt.php', "Multi-Layer Gantt Chart", 1],
    ['', ""],
    ['', "Contour Charts/Heat Maps"],
    ['contour.php', "Contour Chart", 1],
    ['smoothcontour.php', "Continuous Contour Coloring", 1],
    ['scattercontour.php', "Scattered Data Contour Chart", 1],
    ['contourinterpolate.php', "Contour Interpolation", 4],
    ['', ""],
    ['', "Finance Charts"],
    ['hloc.php', "Simple HLOC Chart", 1],
    ['candlestick.php', "Simple Candlestick Chart", 1],
    ['finance.php', "Finance Chart (1)", 1],
    ['finance2.php', "Finance Chart (2)", 1],
    ['<a href="javascript:window.open(\'financedemo.php\', \'financedemo\').focus();">', "Interactive Financial Chart", -1],
    ['', ""],
    ['', "Other XY Chart Features"],
    ['markzone.php', "Marks and Zones (1)", 1],
    ['markzone2.php', "Marks and Zones (2)", 1],
    ['yzonecolor.php', "Y Zone Coloring", 1],
    ['xzonecolor.php', "X Zone Coloring", 1],
    ['dualyaxis.php', "Dual Y-Axis", 1],
    ['dualxaxis.php', "Dual X-Axis", 1],
    ['multiaxes.php', "Multiple Axes", 1],
    ['fourq.php', "4 Quadrant Chart", 1],
    ['datatable.php', "Data Table (1)", 1],
    ['datatable2.php', "Data Table (2)", 1],
    ['fontxy.php', "Text Style and Colors", 1],
    ['background.php', "Background and Wallpaper", 4],
    ['logaxis.php', "Log Scale Axis", 2],
    ['axisscale.php', "Y-Axis Scaling", 5],
    ['ticks.php', "Tick Density", 2],
    ['', ""],
    ['', "3D Surface Charts"],
    ['surface.php', "Surface Chart (1)", 1],
    ['surface2.php', "Surface Chart (2)", 1],
    ['surface3.php', "Surface Chart (3)", 1],
    ['scattersurface.php', "Scattered Data Surface Chart", 1],
    ['surfaceaxis.php', "Surface Chart Axis Types", 1],
    ['surfacelighting.php', "Surface Lighting", 4],
    ['surfaceshading.php', "Surface Shading", 4],
    ['surfacewireframe.php', "Surface Wireframe", 6],
    ['surfaceperspective.php', "Surface Perspective", 6],
    ['', ""],
    ['', "3D Scatter Charts"],
    ['threedscatter.php', "3D Scatter Chart (1)", 1],
    ['threedscatter2.php', "3D Scatter Chart (2)", 1],
    ['threedscattergroups.php', "3D Scatter Groups", 1],
    ['threedscatteraxis.php', "3D Scatter Axis Types", 1],
    ['', ""],
    ['', "Polar/Radar Charts"],
    ['simpleradar.php', "Simple Radar Chart", 1],
    ['multiradar.php', "Multi Radar Chart", 1],
    ['stackradar.php', "Stacked Radar Chart", 1],
    ['polarline.php', "Polar Line Chart", 1],
    ['polararea.php', "Polar Area Chart", 1],
    ['polarspline.php', "Polar Spline Chart", 1],
    ['polarscatter.php', "Polar Scatter Chart", 1],
    ['polarbubble.php', "Polar Bubble Chart", 1],
    ['polarvector.php', "Polar Vector Chart", 1],
    ['rose.php', "Simple Rose Chart", 1],
    ['stackrose.php', "Stacked Rose Chart", 1],
    ['polarzones.php', "Circular Zones", 1],
    ['polarzones2.php', "Sector Zones", 1],
    ['', ""],
    ['', "Pyramids/Cones/Funnels"],
    ['simplepyramid.php', "Simple Pyramid Chart", 1],
    ['threedpyramid.php', "3D Pyramid Chart", 1],
    ['rotatedpyramid.php', "Rotated Pyramid Chart", 1],
    ['cone.php', "Cone Chart", 1],
    ['funnel.php', "Funnel Chart", 1],
    ['pyramidelevation.php', "Pyramid Elevation", 7],
    ['pyramidrotation.php', "Pyramid Rotation", 7],
    ['pyramidgap.php', "Pyramid Gap", 6],
    ['', ""],
    ['', "Meters/Dials/Guages"],
    ['semicirclemeter.php', "Semi-Circle Meter", 1],
    ['roundmeter.php', "Round Meter", 1],
    ['wideameter.php', "Wide Angular Meters", 6],
    ['squareameter.php', "Square Angular Meters", 4],
    ['multiameter.php', "Multi-Pointer Angular Meter", 1],
    ['iconameter.php', "Icon Angular Meter", 1],
    ['hlinearmeter.php', "Horizontal Linear Meter", 1],
    ['vlinearmeter.php', "Vertical Linear Meter", 1],
    ['multihmeter.php', "Multi-Pointer Horizontal Meter", 1],
    ['multivmeter.php', "Multi-Pointer Vertical Meter", 1],
    ['linearzonemeter.php', "Linear Zone Meter", 1],
    ['', ""],
    ['', "Clickable Charts"],
    ['clickbar.php', "Simple Clickable Charts", 0],
    ['jsclick.php', "Javascript Clickable Chart", 0],
    ['customclick.php', "Custom Clickable Objects", 0],
    ['', ""],
    ['', "Working With Database"],
    ['dbdemo1_intro.php', "Database Integration (1)", 0],
    ['dbdemo2_intro.php', "Database Integration (2)", 0],
    ['dbdemo3_intro.php', "Database Clickable Charts", 0],
    ['', ""],
    ['', "Programmable Track Cursor"],
    ['tracklegend.php', "Track Line with Legend", 0],
    ['tracklabel.php', "Track Line with Data Labels", 0],
    ['trackaxis.php', "Track Line with Axis Labels", 0],
    ['trackbox.php', "Track Box with Legend", 0],
    ['trackfinance.php', "Finance Chart Track Line", 0],
    ['crosshair.php', "Crosshair with Axis Labels", 0],
    ['', ""],
    ['', "Zooming and Scrolling"],
    ['<a href="javascript:window.open(\'simplezoomscroll.php\', \'simplezoomscroll\').focus();">', "Simple Zooming and Scrolling", -1],
    ['<a href="javascript:window.open(\'zoomscrolltrack.php\', \'zoomscrolltrack\').focus();">', "Zoom/Scroll with Track Line", -1],
    ['<a href="javascript:window.open(\'xyzoomscroll.php\', \'xyzoomscroll\').focus();">', "XY Zooming and Scrolling", -1],
    ['', ""],
    ['', "Realtime Charts"],
    ['<a href="javascript:window.open(\'realtimedemo.php\', \'realtimedemo\').focus();">', "Simple Realtime Chart", -1],
    ['<a href="javascript:window.open(\'realtimetrack.php\', \'realtimetrack\').focus();">', "Realtime Chart with Track Line", -1],
    ['', ""]
    ];
function setChart(c)
{
    var doc = top.indexright.document;
    doc.open();
    doc.writeln('<body style="margin:5px 0px 0px 5px">');
    doc.writeln('<div style="font-size:18pt; font-family:verdana; font-weight:bold">');
    doc.writeln('    ' + charts[c][1]);
    doc.writeln('</div>');
    doc.writeln('<hr style="border:solid 1px #000080" />');
    doc.writeln('<div style="font-size:10pt; font-family:verdana; margin-bottom:1.5em">');
    doc.writeln('    <a href="viewsource.php?file=' + charts[c][0] + '">View Chart Source Code</a>');
    doc.writeln('</div>');
    if (charts[c][2] > 1)
    {
        for (var i = 0; i < charts[c][2]; ++i)
            doc.writeln('<img src="' + charts[c][0] + '?img=' + i + '">');
    }
    else
        doc.writeln('<img src="' + charts[c][0] + '">');
    doc.writeln('</body>');
    doc.close();
}
</script>
<style type="text/css">
p.demotitle {margin-top:1; margin-bottom:2; padding-left:1; font-family:verdana; font-weight:bold; font-size:9pt;}
p.demolink {margin-top:0; margin-bottom:0; padding-left:3; padding-top:2; padding-bottom:1; font-family:verdana; font-size:8pt;}
</style>
</head>
<body style="margin:0px">
<table width="100%" border="0" cellpadding="0" cellspacing="0" style="font-family:verdana; font-size:8pt;">
<script language="Javascript">
for (var c in charts)
{
    if (charts[c][1] == "")
        document.writeln('<tr><td><p class="demolink">&nbsp;</p></td></tr>');
    if (charts[c][0] == "")
        document.writeln('<tr><td colspan="2" bgcolor="#9999FF"><p class="demotitle">' + charts[c][1] + '</p></td></tr>');
    else
    {
        document.write('<tr valign="top"><td><p class="demolink">&#8226;</p></td><td><p class="demolink">');
        if (charts[c][2] > 0)
            document.write('<a href="javascript:;" onclick="setChart(\'' + c + '\');">');
        else if (charts[c][2] == 0)
               document.write('<a href="' + charts[c][0] + '" target="indexright">');
        else
               document.write(charts[c][0]);
           document.write(charts[c][1]);
           document.writeln('</a></p></td></tr>');
    }
}
</script>
</table>
</body>
</html>
