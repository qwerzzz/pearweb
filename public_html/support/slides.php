<?php
/*
   +----------------------------------------------------------------------+
   | PEAR Web site version 1.0                                            |
   +----------------------------------------------------------------------+
   | Copyright (c) 2004 The PEAR Group                                    |
   +----------------------------------------------------------------------+
   | This source file is subject to version 2.02 of the PHP license,      |
   | that is bundled with this package in the file LICENSE, and is        |
   | available at through the world-wide-web at                           |
   | http://www.php.net/license/2_02.txt.                                 |
   | If you did not receive a copy of the PHP license and are unable to   |
   | obtain it through the world-wide-web, please send a note to          |
   | license@php.net so we can mail you a copy immediately.               |
   +----------------------------------------------------------------------+
   | Authors: Martin Jansen <mj@php.net>                                  |
   +----------------------------------------------------------------------+
   $Id$
*/

response_header("Support - Presentation Slides");
?>

<h1>Support</h1>

<?php
$items = array(
               'Overview' => array('url'   => 'index.php',
                                   'title' => 'Support Overview'
                                   ),
               'Mailing Lists' => array('url'   => 'lists.php',
                                        'title' => 'PEAR Mailing Lists'
                                        ),
               'Tutorials' => array('url'   => 'tutorials.php',
                                    'title' => 'Tutorials about PEAR (packages)'
                                    ),
               'Presentation Slides' => array('url'   => 'slides.php',
                                              'title' => 'Slides of presentations about PEAR'
                                              ),
               'Icons' => array('url'   => 'icons.php',
                                'title' => 'PEAR icons'
                                )
               );

print_tabbed_navigation($items);
?>

<h2>&raquo; Presentation Slides</h2>

<p>The following is a list of pointers to the slides of presentations
that have been held about PEAR.</p>

<ul>
 <li>
  <p><cite>
   <a href="http://www.php-tools.net/site.php?file=/about/presentations.xml">
   PEAR for the masses</a></cite></p>
  <ul>
    <li>Date: 2004-07-30</li>
    <li>Presenters: <?php echo user_link("schst", true); ?></li>
    <li>Venue: O'Reilly Open Source Conference 2004, Portland/Oregon, United States</li>
    <li>Language: English</li>
  </ul>
 </li>

 <li>
  <p><cite>
   <a href="http://www.schlitt.info/index.php/content.publications_linuxtag2004">PEAR - An introduction</a>
  </cite></p>
  <ul>
    <li>Date: 2004-06-25</li>
    <li>Presenters: <?php echo user_link("lsmith", true); ?> and <?php echo user_link("toby", true); ?></li>
    <li>Venue: Linuxtag 2004, Karlsruhe, Germany</li>
    <li>Language: English</li>
  </ul>
 </li>

 <li>
  <p><cite><a href="http://www.phpconf.hu/rsduf/media/eloadasok/PEAR.pdf">
  PEAR</cite></a></p>
  <ul>
    <li>Date: 2004-05-29</li>
    <li>Presenter: <?php echo user_link("norbert", true); ?></li>
    <li>Venue: First Hungarian PHP Roadshow 2004, Dunaujvaros, Hungary</li>
    <li>Language: Hungarian</li>
  </ul>
 </li>

 <li>
  <p><cite><a href="http://www.schlitt.info/download/PEAR_Powerworkshop_Spring_2004.tar.gz">
  PEAR not just a fleshy pome</cite></a></p>
  <ul>
    <li>Date: 2004-05-03</li>
    <li>Presenters: <?php echo user_link("lsmith", true); ?> and <?php echo user_link("toby", true); ?></li>
    <li>Venue: PEAR Powerworkshop, Internation PHP Conference Spring Edition, 
    Amsterdam, Netherlands</li>
    <li>Language: English</li>
  </ul>
 </li>

 <li>
  <p><cite><a href="http://www.schlitt.info/index.php/content.publications_phpconf2003ffm">
  PEAR im Einsatz</a></cite></p>
  <ul>
    <li>Date: 2003-11-04</li>
    <li>Presenter: <?php echo user_link("toby", true); ?></li>
    <li>Venue: Internation PHP Conference, Frankfurt, Germany</li>
    <li>Language: German</li>
  </ul>
 </li>

 <li>
  <p><cite><a href="http://www.php-con.com/2003/west/pdf/christian_wenz_archive.pdf">
  Tour de PEAR</a></cite></p>
  <ul>
    <li>Date: 2003-10-24</li>
    <li>Presenter: <?php echo user_link("wenz", true); ?></li>
    <li>Venue: php{con West 2003, Santa Clara, United States</li>
    <li>Language: English</li>
  </ul>
 </li>

 <li>
  <p><cite><a href="http://talks.php.net/show/sdphp_using_tools">
  Making your (coding) life simpler</a></cite></p>
  <ul>
    <li>Date: 2003-06-05</li>
    <li>Presenter: <?php echo user_link("jmcastagnetto", true); ?></li>
    <li>Venue: SDPHP monthly meeting, San Diego, United States</li>
    <li>Language: English</li>
  </ul>
 </li>

 <li>
  <p><cite><a href="http://conf2.php.net/show/powerpear">
  Teach Yourself PEAR in 6 Hours</a></cite></p>
  <ul>
    <li>Date: 2002-11-03</li>
    <li>Presenter: <?php echo user_link("ssb", true); ?></li>
    <li>Venue: International PHP Conference, Frankfurt, Germany</li>
    <li>Language: English</li>
  </ul>
 </li>

 <li>
  <p><cite><a href="http://conf.php.net/pres/slides/pres/index.php?p=slides%2Fpear%2Flt2002&amp;id=pearlt2002">
  The State of (the) PEAR</a></cite></p>
  <ul>
    <li>Date: 2002-06-08</li>
    <li>Presenter: <?php echo user_link("ssb", true); ?></li>
    <li>Venue: LinuxTag, Karlsruhe, Germany</li>
    <li>Language: English</li>
  </ul>
 </li>

 <li>
  <p><cite><a href="http://conf.php.net/pear2">
  The PHP Extension and Application Repository</a></cite></p>
  <ul>
    <li>Date: 2001-07-26</li>
    <li>Presenter: <?php echo user_link("jon", true); ?></li>
    <li>Venue: O&apos;Reilly Open Source Convention 2001, San Diego,
        United States</li>
    <li>Language: English</li>
  </ul>
 </li>

 <li>
  <p><cite><a href="http://conf.php.net/pres/index.php?p=slides%2Fpear&amp;id=pear">
  The PHP Extension and Application Repository</a></cite></p>
  <ul>
    <li>Date: 2001-04-05</li>
    <li>Presenter: <?php echo user_link("ssb", true); ?></li>
    <li>Venue: ApacheCon 2001, Santa Clara, United States</li>
    <li>Language: English</li>
  </ul>
 </li>
</ul>

<p><a href="/support/">&laquo; Back to the Support overview</a></p>

<?php echo hdelim(); ?>

<p>Do you know of other presentation slides that should be added here? 
Please let the <a href="mailto:pear-webmaster@lists.php.net">webmaster 
team</a> know about them.</p>

<?php
response_footer();
?>