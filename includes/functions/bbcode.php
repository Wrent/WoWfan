<?php
function bbcode ($text)
  //BB code -> HTML
  //contains normal BB code and some new marks too
      {
      //classic BB marks
      $text = preg_replace('#\[b\](.*?)\[/b\]#si', '<strong>\1</strong>', $text);
      $text = preg_replace('#\[i\](.*?)\[/i\]#si', '<em>\1</em>', $text);
      $text = preg_replace('#\[u\](.*?)\[/u\]#si', '<u>\1</u>', $text);
      $text = preg_replace('#\[s\](.*?)\[/s\]#si', '<del>\1</del>', $text);
      $text = preg_replace('#\[sub\](.*?)\[/sub\]#si', '<sub>\1</sub>', $text);
      $text = preg_replace('#\[sup\](.*?)\[/sup\]#si', '<sup>\1</sup>', $text);
      $text = preg_replace('#\[tt\](.*?)\[/tt\]#si', '<tt>\1</tt>', $text);
      $text = preg_replace('#\[list\](.*?)\[/list\]#si', '<ul>\1</ul>', $text);
      $text = preg_replace('#\[li\](.*?)\[/li\]#si', '<li>\1', $text);
      $text = preg_replace('#\[move\](.*?)\[/move\]#si', '<marquee>\1</marquee>', $text);
      $text = preg_replace('#\[pre\](.*?)\[/pre\]#si', '<pre>\1</pre>', $text);
      $text = preg_replace('#\[code\](.*?)\[/code\]#si', '<code>\1</code>', $text);
      $text = preg_replace('#\[quote\](.*?)\[/quote\]#si', '<blockquote>\1</blockquote>', $text);
      $text = preg_replace('#\[center\](.*?)\[/center\]#si', '<center>\1</center>', $text);
      $text = preg_replace('#\[right\](.*?)\[/right\]#si', '<div style="text-align: right;">\1</div>', $text);
      $text = preg_replace('#\[left\](.*?)\[/left\]#si', '<div style="text-align: left;">\1</div>', $text);
      $text = preg_replace('#\[just\](.*?)\[/just\]#si', '<div style="text-align: justify;">\1</div>', $text);
      
      //medium and small header
      $text = preg_replace('#\[h2\](.*?)\[/h2\]#si', '<h2>\1</h2>', $text);
      $text = preg_replace('#\[h3\](.*?)\[/h3\]#si', '<h3>\1</h3>', $text);
      
      //special separator
      $text = preg_replace('#\[hr]#si', '<hr>', $text);
      
      //galery powered by jQuery
      $text = preg_replace('#\[gal s=(.*?)\ p=(.*?)\](.*?)\[/gal\]#si', '<a href="\3" class="galerie" target="_blank"><img src="\1" alt="\2" border="0"></a>', $text);
      
      //another BB marks
      $text = preg_replace('#\[size=([0-9]*?)pt\](.*?)\[/size\]#si', '<span style=\'font-size:\1\'>\2</span>', $text);
      $text = preg_replace('#\[color=(black|blue|brown|cyan|gray|pink|green|lime|maroon|navy|olive|orange|purple|red|silver|violet|white|yellow|teal|beige)\](.*?)\[/color\]#si', '<span style=\'color:\1\'>\2</span>', $text);

      $text = preg_replace('#\[classc=dk\](.*?)\[/classc\]#si', '<span style=\'color:#C41E3B !important\'>\1</span>', $text);
      $text = preg_replace('#\[classc=druid\](.*?)\[/classc\]#si', '<span style=\'color:#FF7C0A !important\'>\1</span>', $text);
      $text = preg_replace('#\[classc=hunter\](.*?)\[/classc\]#si', '<span style=\'color:#AAD372 !important\'>\1</span>', $text);
      $text = preg_replace('#\[classc=mage\](.*?)\[/classc\]#si', '<span style=\'color:#68CCEF !important\'>\1</span>', $text);
      $text = preg_replace('#\[classc=monk\](.*?)\[/classc\]#si', '<span style=\'color:#008467 !important\'>\1</span>', $text);
      $text = preg_replace('#\[classc=paladin\](.*?)\[/classc\]#si', '<span style=\'color:#F48CBA !important\'>\1</span>', $text);
      $text = preg_replace('#\[classc=priest\](.*?)\[/classc\]#si', '<span style=\'color:#FFFFFF !important\'>\1</span>', $text);
      $text = preg_replace('#\[classc=rogue\](.*?)\[/classc\]#si', '<span style=\'color:#FFF468 !important\'>\1</span>', $text);
      $text = preg_replace('#\[classc=shaman\](.*?)\[/classc\]#si', '<span style=\'color:#2359FF !important\'>\1</span>', $text);
      $text = preg_replace('#\[classc=warlock\](.*?)\[/classc\]#si', '<span style=\'color:#9382C9 !important\'>\1</span>', $text);
      $text = preg_replace('#\[classc=warrior\](.*?)\[/classc\]#si', '<span style=\'color:#C69B6D !important\'>\1</span>', $text);

      $text = preg_replace('#\[font=(.*?)\](.*?)\[/font\]#si', '<span style=\'font-family:\1\'>\2</span>', $text);
      
      //hyperlinks, ref is set to 'nofollow'
      $text = preg_replace('#\[url\]([\r\n]*)(http://|ftp://|https://|ftps://)([^\s\'\";\+]*?)([\r\n]*)\[/url\]#si', '<a rel="nofollow" href=\'\2\3\' target=\'_blank\'>\2\3</a>', $text);
      $text = preg_replace('#\[url\]([\r\n]*)([^\s\'\";\+]*?)([\r\n]*)\[/url\]#si', '<a rel="nofollow" href=\'http://\2\' target=\'_blank\'>\2</a>', $text);
      $text = preg_replace('#\[url=([\r\n]*)(http://|ftp://|https://|ftps://)([^\s\'\";\+]*?)\](.*?)([\r\n]*)\[/url\]#si', '<a rel="nofollow" href=\'\2\3\' target=\'_blank\'>\4</a>', $text);
      $text = preg_replace('#\[url=([\r\n]*)([^\s\'\";\+]*?)\](.*?)([\r\n]*)\[/url\]#si', '<a rel="nofollow" href=\'http://\2\' target=\'_blank\'>\3</a>', $text);
      $text = preg_replace('#\[email\]([\r\n]*)([^\s\'\";:\+]*?)([\r\n]*)\[/email\]#si', '<a href=\'mailto:\2\'>\2</a>', $text);
      $text = preg_replace('#\[email=([\r\n]*)([^\s\'\";:\+]*?)\](.*?)([\r\n]*)\[/email\]#si', '<a href=\'mailto:\2\'>\3</a>', $text);
      
      //youtube video
      $text = preg_replace('#\[video\](.*?)\[/video\]#si', '<center><object width="425" height="350"><param name="movie" value="http://www.youtube.com/v/\1"></param><embed src="http://www.youtube.com/v/\1" type="application/x-shockwave-flash" width="425" height="350"></embed></object></center>', $text);
      
      //picture, you have to write down align and alt
      $text = preg_replace("#\[img align=right popis=(.*?)\](.*?)(\.(jpg|jpeg|gif|png|JPG|JPEG|GIF|PNG))\[/img\]#sie","'<img align=\'right\' src=\'\\2\\3\' style=\'border:0px\' alt=\'\\1\'>'",$text);
      $text = preg_replace("#\[img align=baseline popis=(.*?)\](.*?)(\.(jpg|jpeg|gif|png|JPG|JPEG|GIF|PNG))\[/img\]#sie","'<img src=\'\\2\\3\' style=\'border:0px; box-shadow: black 4px 6px 20px; -webkit-box-shadow: black 4px 6px 20px; -moz-box-shadow: black 4px 6px 20px;\' alt=\'\\1\'>'",$text);
      $text = preg_replace("#\[img align=left popis=(.*?)\](.*?)(\.(jpg|jpeg|gif|png|JPG|JPEG|GIF|PNG))\[/img\]#sie","'<img align=\'left\' src=\'\\2\\3\' style=\'border:0px\' alt=\'\\1\'>'",$text);
      
      //WoWhead plugin - items, spells etc... set to 'nofollow'
      $text = preg_replace("#\[poor=([0-9]*?)\](.*?)\[/poor\]#sie","'<a rel=\"nofollow\" href=\"http://wowhead.com/?item=\\1\" target=\'_blank\' class=\'poor\'>\\2</a>'",$text);
      $text = preg_replace("#\[common=([0-9]*?)\](.*?)\[/common\]#sie","'<a rel=\"nofollow\" href=\"http://wowhead.com/?item=\\1\" target=\'_blank\' class=\'common\'>\\2</a>'",$text);
      $text = preg_replace("#\[uncommon=([0-9]*?)\](.*?)\[/uncommon\]#sie","'<a rel=\"nofollow\" href=\"http://wowhead.com/?item=\\1\" target=\'_blank\' class=\'uncommon\'>\\2</a>'",$text);
      $text = preg_replace("#\[rare=([0-9]*?)\](.*?)\[/rare\]#sie","'<a rel=\"nofollow\" href=\"http://wowhead.com/?item=\\1\" target=\'_blank\' class=\'rare\'>\\2</a>'",$text);
      $text = preg_replace("#\[epic=([0-9]*?)\](.*?)\[/epic\]#sie","'<a rel=\"nofollow\" href=\"http://wowhead.com/?item=\\1\" target=\'_blank\' class=\'epic\'>\\2</a>'",$text);
      $text = preg_replace("#\[legendary=([0-9]*?)\](.*?)\[/legendary\]#sie","'<a rel=\"nofollow\" href=\"http://wowhead.com/?item=\\1\" target=\'_blank\' class=\'legendary\'>\\2</a>'",$text);
      $text = preg_replace("#\[spell=([0-9]*?)\](.*?)\[/spell\]#sie","'<a rel=\"nofollow\" rel=\"nofollow\" href=\"http://wowhead.com/?spell=\\1\" target=\'_blank\' class=\'spell\'>\\2</a>'",$text);
      $text = preg_replace("#\[achi=([0-9]*?)\](.*?)\[/achi\]#sie","'<a rel=\"nofollow\" href=\"http://wowhead.com/?achievement=\\1\" target=\'_blank\' class=\'achi\'>\\2</a>'",$text);
      $text = preg_replace("#\[quest=([0-9]*?)\](.*?)\[/quest\]#sie","'<a rel=\"nofollow\" href=\"http://wowhead.com/?quest=\\1\" target=\'_blank\' class=\'quest\'>\\2</a>'",$text);
      
      //WoWhead plugin - items, spells etc... set to 'nofollow'
      $text = preg_replace("#\[ppoor=([0-9]*?)\](.*?)\[/ppoor\]#sie","'<a rel=\"nofollow\" href=\"http://ptr.wowhead.com/?item=\\1\" target=\'_blank\' class=\'poor\'>\\2</a>'",$text);
      $text = preg_replace("#\[pcommon=([0-9]*?)\](.*?)\[/pcommon\]#sie","'<a rel=\"nofollow\" href=\"http://ptr.wowhead.com/?item=\\1\" target=\'_blank\' class=\'common\'>\\2</a>'",$text);
      $text = preg_replace("#\[puncommon=([0-9]*?)\](.*?)\[/puncommon\]#sie","'<a rel=\"nofollow\" href=\"http://ptr.wowhead.com/?item=\\1\" target=\'_blank\' class=\'uncommon\'>\\2</a>'",$text);
      $text = preg_replace("#\[prare=([0-9]*?)\](.*?)\[/prare\]#sie","'<a rel=\"nofollow\" href=\"http://ptr.wowhead.com/?item=\\1\" target=\'_blank\' class=\'rare\'>\\2</a>'",$text);
      $text = preg_replace("#\[pepic=([0-9]*?)\](.*?)\[/pepic\]#sie","'<a rel=\"nofollow\" href=\"http://ptr.wowhead.com/?item=\\1\" target=\'_blank\' class=\'epic\'>\\2</a>'",$text);
      $text = preg_replace("#\[plegendary=([0-9]*?)\](.*?)\[/plegendary\]#sie","'<a rel=\"nofollow\" href=\"http://ptr.wowhead.com/?item=\\1\" target=\'_blank\' class=\'legendary\'>\\2</a>'",$text);
      $text = preg_replace("#\[pspell=([0-9]*?)\](.*?)\[/pspell\]#sie","'<a rel=\"nofollow\" rel=\"nofollow\" href=\"http://ptr.wowhead.com/?spell=\\1\" target=\'_blank\' class=\'spell\'>\\2</a>'",$text);
      $text = preg_replace("#\[pachi=([0-9]*?)\](.*?)\[/pachi\]#sie","'<a rel=\"nofollow\" href=\"http://ptr.wowhead.com/?achievement=\\1\" target=\'_blank\' class=\'achi\'>\\2</a>'",$text);
      $text = preg_replace("#\[pquest=([0-9]*?)\](.*?)\[/pquest\]#sie","'<a rel=\"nofollow\" href=\"http://ptr.wowhead.com/?quest=\\1\" target=\'_blank\' class=\'quest\'>\\2</a>'",$text);
      

      //WoWhead plugin - items, spells etc... set to 'nofollow'
      $text = preg_replace("#\[bpoor=([0-9]*?)\](.*?)\[/bpoor\]#sie","'<a rel=\"nofollow\" href=\"http://mop.wowhead.com/?item=\\1\" target=\'_blank\' class=\'poor\'>\\2</a>'",$text);
      $text = preg_replace("#\[bcommon=([0-9]*?)\](.*?)\[/bcommon\]#sie","'<a rel=\"nofollow\" href=\"http://mop.wowhead.com/?item=\\1\" target=\'_blank\' class=\'common\'>\\2</a>'",$text);
      $text = preg_replace("#\[buncommon=([0-9]*?)\](.*?)\[/buncommon\]#sie","'<a rel=\"nofollow\" href=\"http://mop.wowhead.com/?item=\\1\" target=\'_blank\' class=\'uncommon\'>\\2</a>'",$text);
      $text = preg_replace("#\[brare=([0-9]*?)\](.*?)\[/brare\]#sie","'<a rel=\"nofollow\" href=\"http://mop.wowhead.com/?item=\\1\" target=\'_blank\' class=\'rare\'>\\2</a>'",$text);
      $text = preg_replace("#\[bepic=([0-9]*?)\](.*?)\[/bepic\]#sie","'<a rel=\"nofollow\" href=\"http://mop.wowhead.com/?item=\\1\" target=\'_blank\' class=\'epic\'>\\2</a>'",$text);
      $text = preg_replace("#\[blegendary=([0-9]*?)\](.*?)\[/blegendary\]#sie","'<a rel=\"nofollow\" href=\"http://mop.wowhead.com/?item=\\1\" target=\'_blank\' class=\'legendary\'>\\2</a>'",$text);
      $text = preg_replace("#\[bspell=([0-9]*?)\](.*?)\[/bspell\]#sie","'<a rel=\"nofollow\" rel=\"nofollow\" href=\"http://mop.wowhead.com/?spell=\\1\" target=\'_blank\' class=\'spell\'>\\2</a>'",$text);
      $text = preg_replace("#\[bachi=([0-9]*?)\](.*?)\[/bachi\]#sie","'<a rel=\"nofollow\" href=\"http://mop.wowhead.com/?achievement=\\1\" target=\'_blank\' class=\'achi\'>\\2</a>'",$text);
      $text = preg_replace("#\[bquest=([0-9]*?)\](.*?)\[/bquest\]#sie","'<a rel=\"nofollow\" href=\"http://mop.wowhead.com/?quest=\\1\" target=\'_blank\' class=\'quest\'>\\2</a>'",$text);
      

      //new row
      $text = str_replace("[br]","<br>",$text);
      
      //blue post
      $text = preg_replace('#\[blue=(.*?)\](.*?)\[/blue\]#si', '<div class="blue"><div class="blueheader"><img src="pic/design/bluepost.gif" alt="blue post" align="left">Oficiálně od Blizzardu <a href="\1" target="_blank">(Zdroj)</a></div><br>\2</div>', $text);
      $text = preg_replace('#\[blue zdroj=(.*?) poster=(.*?)\](.*?)\[/blue\]#si', '<div class="blue"><div class="blueheader"><img src="pic/design/bluepost.gif" alt="blue post" align="left">\2 <a href="\1" target="_blank">(Zdroj)</a></div><br>\3</div>', $text);
      
      
      $folder_counter=preg_match_all('#\[folder small=(.*?)\](.*?)\[/folder\]#si',$text,$cisla);
      //images folder gallery
      while($folder_counter-- > 0) {
            $folder = preg_match('#\[folder small=(.*?)\](.*?)\[/folder\]#si', $text, $matches);
            if ($folder)
                  {
                        $prepath = "/users/herniweb.cz/";
                        $path = $prepath.$matches[2];
                        if ($matches[1]=="TRUE")
                              $pathSmall = $prepath.$matches[2]."small/";
                        else
                              $pathSmall = FALSE;

                        if (is_dir($path) && (!$pathSmall || is_dir($pathSmall))) {


                              $matches[2] = substr($matches[2], 4);

                              $images = scandir($path);
                              if ($pathSmall)
                                    $small = scandir($pathSmall);

                              if ($pathSmall) {
                                    foreach ($images as $key => $value) {
                                          if ($key < 2)
                                                continue;
                                          //is it really an image??
                                          if (!isImage($value))
                                                continue;
                                          //does miniature exist?
                                          if (!in_array($value, $small))
                                                continue;
                                          $new_text .= "<a href='http://media.wowfan.cz/$matches[2]$value' class='galerie' target='_blank'><img src='http://media.wowfan.cz/$matches[2]small/$value' alt=".substr($value, 0, -4)." border='0'></a> ";
                                    }
                              }
                              else {
                                    foreach ($images as $key => $value) {
                                          if ($key < 2)
                                                continue;
                                          //is it really an image??
                                          if (!isImage($value))
                                                continue;
                                          $new_text .= "<img src='http://media.wowfan.cz/$matches[2]$value' alt=".substr($value, 0, -4)." border='0' style='border:0px; box-shadow: black 4px 6px 20px; -webkit-box-shadow: black 4px 6px 20px; -moz-box-shadow: black 4px 6px 20px;'> ";
                                    }
                              }
                        }
                        else {
                              $new_text .= "TOTO NENÍ PLATNÁ SLOŽKA";
                        }
                  }
            $text = preg_replace('#\[folder small=(.*?)\](.*?)\[/folder\]#si', $new_text, $text, 1);
            unset($new_text);
      }


      //spoiler - hide / show
      $spoiler_counter=preg_match_all('#\[spoiler\](.*?)\[/spoiler\]#si',$text,$cisla);
      $sp=$spoiler_counter+$GLOBALS["counter_spoiler"];
      while($sp>$GLOBALS["counter_spoiler"])
        {
        $text = preg_replace('#\[spoiler\](.*?)\[/spoiler\]#si', '<div align="center"><a id="'.$GLOBALS["counter_spoiler"].'" class="spoil_toggle">SPOILER - Zobraz / Skryj</a></div><br>
        <div id="'.$GLOBALS["counter_spoiler"]++.'_spoiler" class="spoiler">\1</div>', $text, 1);
        }
        
      //normal design has adds there
      //spocita kolikrat se nahradi odstavec
      $count=0;
      str_replace("[odstavec]","[odstavec]",$text,$count);
      $i=0;
      while ($i<=$count)
        {
        $text = preg_replace('#\[odstavec\]#si', '', $text, 1);                   
        $i++;
        }
      return $text;
      }
      
function bbcode_comment ($text)
      {
      //klasicke BB znacky
      $text = preg_replace('#\[b\](.*?)\[/b\]#si', '<strong>\1</strong>', $text);
      $text = preg_replace('#\[i\](.*?)\[/i\]#si', '<em>\1</em>', $text);
      $text = preg_replace('#\[u\](.*?)\[/u\]#si', '<u>\1</u>', $text);
      $text = preg_replace('#\[s\](.*?)\[/s\]#si', '<del>\1</del>', $text);
      $text = preg_replace('#\[quote\](.*?)\[/quote\]#si', '<blockquote>\1</blockquote>', $text);
      $text = preg_replace('#\[quote=(.*?)\](.*?)\[/quote\]#si', '<blockquote><cite>\1</cite><br>\2</blockquote>', $text);
      $text = preg_replace('#\[color=(black|blue|brown|cyan|gray|pink|green|lime|maroon|navy|olive|orange|purple|red|silver|violet|white|yellow|teal|beige)\](.*?)\[/color\]#si', '<span style=\'color:\1\'>\2</span>', $text);
      //okdazy, rel je nastaveno na nofollow 
      $text = preg_replace('#\[url\]([\r\n]*)(http://|ftp://|https://|ftps://)([^\s\'\";\+]*?)([\r\n]*)\[/url\]#si', '<a rel="nofollow" href=\'\2\3\' target=\'_blank\'>\2\3</a>', $text);
      $text = preg_replace('#\[url\]([\r\n]*)([^\s\'\";\+]*?)([\r\n]*)\[/url\]#si', '<a rel="nofollow" href=\'http://\2\' target=\'_blank\'>\2</a>', $text);
      $text = preg_replace('#\[url=([\r\n]*)(http://|ftp://|https://|ftps://)([^\s\'\";\+]*?)\](.*?)([\r\n]*)\[/url\]#si', '<a rel="nofollow" href=\'\2\3\' target=\'_blank\'>\4</a>', $text);
      $text = preg_replace('#\[url=([\r\n]*)([^\s\'\";\+]*?)\](.*?)([\r\n]*)\[/url\]#si', '<a rel="nofollow" href=\'http://\2\' target=\'_blank\'>\3</a>', $text);
      return $text;
      }
?>
