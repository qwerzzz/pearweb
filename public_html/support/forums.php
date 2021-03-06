<?php
/*
   +----------------------------------------------------------------------+
   | PEAR Web site version 1.0                                            |
   +----------------------------------------------------------------------+
   | Copyright (c) 2004-2005 The PEAR Group                               |
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

response_header('Support - Forums');
?>


<p>The following is a list of pointers to external forums about
PEAR packages.</p>

<ul class="spaced">
 <li>
  <a href="http://forums.codewalkers.com/pear-packages-47/">Codewalker</a>: PEAR Forum.
 </li>
 <li>
  <a href="http://www.pear-forum.org/">pear-forum.org</a>: forum dedicated to PEAR
 </li>
 <li>
  <a href="http://www.pear-forum.de">pear-forum.de</a>: German PEAR forum.
 </li>
</ul>

<hr />

<p>Do you know of other forums that should be added here?
Please let the <a href="mailto:<?php echo PEAR_WEBMASTER_EMAIL ?>">webmaster
team</a> know about them.</p>

<?php
response_footer();
