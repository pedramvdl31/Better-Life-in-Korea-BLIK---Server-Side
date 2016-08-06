        <!-- CHAT -->
        <style type="text/css">
            .chrome .dock_wrapper {
            transform: translateZ(0);
            }
            .dockWrapperRight,.dockWrapperRightChilds {
                left: auto;
            }
            .dock-min {
                bottom: 4px;
                direction: ltr;
                height: 28px;
                left: 0;
                position: fixed;
                right: 0;
                z-index: 5;
            }
            .dock-max-height{
              bottom: 295px;  
            }
            .dock-max {
                direction: ltr;
                height: 28px;
                left: 0;
                position: fixed;
                right: 0;
                z-index: 5;
            }
            .dock-max-1 {
                bottom: 280px;
                direction: ltr;
                height: 28px;
                left: 0;
                position: fixed;
                right: 285px;
                z-index: 5;
            }
            .toright{
                right: 285px !important;
            }
            .dock-max-2 {
                bottom: 280px;
                direction: ltr;
                height: 28px;
                left: 0;
                position: fixed;
                right: 570px;
                z-index: 5;
            }
            .tvis{
                z-index: 8 !important;
                opacity: 1 !important;
            }
            ._dock {
            margin: 0 15px 0 0;
            }

            .m_clearfix {
            zoom: 1;
            }
            .m_clearfix:after {
            clear: both;
            content: ".";
            display: block;
            font-size: 0;
            height: 0;
            line-height: 0;
            visibility: hidden;
            }
            ._dock .rNubContainer {
            float: right;
            }
            .nubContainer>div, ._dock {
            float: right;
            position: relative;
            }
            .rNubContainer ._50-v {
            margin-left: 12px;
            }

            ._4mq3.wpNub, ._4mq3.wpNub.openToggler {
            margin-left: 12px;
            margin-right: 1px;
            }
            ._50-v, .wpNubGroup, .wpDock .nubContainer>div, .wpDock .wpNubGroup>div {
            float: left;
            position: relative;
            }
            ._4mq3 {
            height: 25px;
            min-width: 201px;
            width: 276px;
            }
            ._4mq3 .wpNubButton {
            background-color: #f6f7f8;
            border: 1px solid rgba(29, 49, 91, .3);
            border-top-left-radius: 3px;
            border-top-right-radius: 3px;
            box-shadow: none;
            padding-left: 12px;
            padding-right: 12px;
            }
            ._4mq3 .wpNubButton-max {
                background-color: #f6f7f8;
                border: 1px solid rgba(29, 49, 91, .3);
                border-top-left-radius: 3px;
                border-top-right-radius: 3px;
                padding-left: 0;
                padding-right: 0;
                padding-top: 2px;
            }
            .wpNubButton, .wpNubButton:hover,.wpNubButton-max, ._50-v.openToggler .wpNubButton, .wpNubFlyout, .wpNubFlyout .flyoutInner, .wpNubFlyoutTitlebar, .wpNubFlyoutHeader, .wpNubFlyoutBody, .wpNubFlyoutFooter {
            background-clip: padding-box;
            }
            .wpNubButton {
                border: 1px solid rgba(29, 49, 91, .3);
                border-width: 1px 0 0;
                color: #333;
                display: block;
                font-weight: bold;
                height: 69px;
                outline: none;
                padding: 6px 4px 5px;
                position: relative;
                z-index: 1;
            }
            .wpNubButton-max {
                background: transparent;
                box-shadow: 0 1px 1px rgba(0, 0, 0, .3);
                border: 1px solid rgba(29, 49, 91, .3);
                border-width: 1px 0 0;
                color: #333;
                display: block;
                font-weight: bold;
                min-height: 311px;
                height: 311px;
                outline: none;
                padding: 6px 4px 5px;
                position: relative;
                z-index: 1;
            }
            .wpNubButton-max-main {
                background: transparent;
                box-shadow: 0 2px 8px 0 rgba(0, 0, 0, .3);
                border: 1px solid rgba(29, 49, 91, .3);
                border-width: 1px 0 0;
                color: #333;
                display: block;
                font-weight: bold;
                min-height: 311px;
                height: 325px;
                outline: none;
                padding: 6px 4px 5px;
                position: relative;
                z-index: 1;
            }
            .wpNubButton:before, .wpNubButton:after,.wpNubButton-max:before, .wpNubButton-max:after {
            content: '';
            height: 28px;
            position: absolute;
            top: -1px;
            width: 4px;
            }
            ._4mq3 .wpNubButton:before, ._4mq3 .wpNubButton:after,._4mq3 .wpNubButton-max:before, ._4mq3 .wpNubButton-max:after, {
            background-image: none;
            }
            .wpNubButton:after,.wpNubButton-max:after {
            background-repeat: no-repeat;
            background-size: auto;
            background-position: -15px -40px;
            right: -4px;
            }
            .wpNubButton:before, .wpNubButton:after,.wpNubButton-max:before, .wpNubButton-max:after {
            content: '';
            height: 28px;
            position: absolute;
            top: -1px;
            width: 4px;
            }
            .ChatTextArea{
                white-space: pre-wrap;       /* css-3 */
                white-space: -moz-pre-wrap;  /* Mozilla, since 1999 */
                white-space: -pre-wrap;      /* Opera 4-6 */
                white-space: -o-pre-wrap;    /* Opera 7 */
                word-wrap: break-word;       /* Internet Explorer 5.5+ */
                width: 86%;
                background: white;
                height: 36px;
                text-align: left;
                border-top: 1px solid #C7C7C7;
                float: left;
                padding: 3px;
                overflow: auto;
                word-break: break-all;
            }
            .chatemoji{
                width: 14%;
                float: right;
                height: 52px;
                background: white;
                border-top: 1px solid #C7C7C7;
                text-align: center;
            }
            .emoi{ 
                cursor: pointer;
                color: gray;
                font-size: 29px;
                padding-top: 11px;
            }
            #ew1{
                z-index: 100;
                position: absolute;
                top: 107px;
                padding: 7px;
                right: 4px;
                height: 150px;
                width: 164px;
                border: 0;
                border-radius: 2px;
                box-shadow: 0 0 0 1px rgba(0, 0, 0, .1), 0 1px 10px rgba(0, 0, 0, .35);
                background-color: white;
            }
            .el1{
                position: relative;
                overflow: auto;
                background-color: inherit;
            }

            .emoji-list>pre>code>.emoticon{
                cursor: pointer;
            }
            ._4mq3 .wpNubButton .label {
            color: black;
            font-size: 14px;
            line-height: 16px;
            margin-right: 4px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            }
            ._4mq3 .wpNubButton-max .label {
            color: black;
            font-size: 14px;
            line-height: 16px;
            margin-right: 4px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            }
            .lb-m{
            padding-left: 20px;
            line-height: 35px !important;
            }
            #inner-chat-wrapper{
            height: 100%;
            background-color: #f6f7f8;;
            border-top: 1px solid rgba(29, 49, 91, .3); 
            padding: 5px 10px;
            max-height: 285px;
            overflow-y: scroll;
            }
            .inner-wrapper-child{
            width: 100%
            height: 100%;
            background-color: #f6f7f8;;
            border-top: 1px solid rgba(29, 49, 91, .3); 
            padding: 5px 10px;
            max-height: 257px;
            }
            .conv-wrapper {
            height: 40px;
            margin-bottom: 2px;
            }
            .conv-wrapper img {
            width: 39px;
            }
            .sp_BNtOXyg0vlE {
            background-size: auto;
            background-repeat: no-repeat;
            display: inline-block;
            height: 12px;
            width: 16px;
            }
            ._4mq3 .wpNubButton ._4xia {
            float: left;
            height: 12px;
            margin: 2px 4px 0 0;
            width: 12px;
            }
            .sp_BNtOXyg0vlE.sx_78fc23 {
            width: 12px;
            background-position: -75px -471px;
            }
            .conv-c{
            float: right;
            margin-top: 5px;
            font-size: 19px;
            color: #337AB7 !important;
            }
            .have-msg{
            float: right;
            color: #337AB7 !important;
            }
            .ChatClose{
            margin-right: 8px;
            }

            #cta1{
            height: 52px;
            }
            #cta2{
            height: 52px;
            }
            .tooltip {
            position: fixed;
            }
            ._mb {
            position: relative;
            display: inline-block;
            margin: .5em .75em;
            padding: 6px 15px 6px 15px;
            border-radius: 1.5em;
            text-shadow: 0 1px 1px white;
            background-color: #fff;
            border: 1px solid #CDCDCA;
            box-shadow: 0 1px 1px 0 #CDCDCA;
            overflow: hidden;
            }
            ._msnd{
            text-align: right;   
            width: 100%;
            }
            ._mrcv{
            text-align: left;
            width: 100%;
            }
            ._mtxt{
            color: #373e4d;
            text-shadow: rgba(255, 255, 255, .5) 0 1px 0;
            line-height: 1.28;
            font-size: 12px;
            word-break: break-word;
            }
            ._sndb {
            background-color: #e0edff !important;
            border: 1px solid #bcc7d6 !important;
            border-top-right-radius: 0;
            }
            ._rcvb {
            border-top-left-radius: 0;
            }
            ._msgss{
            /*MESSAGES SEND*/
            float: right;
            width: 100%;
            }
            ._mavs{
            float: right;
            width: 15%;
            }
            ._mtwps{
            float: right;
            width: 85%;
            }
            ._msgsr{
            /*MESSAGES RECVED*/
            float: left;
            width: 100%;
            }
            ._mavr{
            float: left;
            width: 15%;
            }
            ._mtwpr{
            float: left;
            width: 85%;
            }
            ._mtime{
            color: #9197a3;
            display: inline-block;
            font-size: 10px;
            font-weight: bold;
            padding: 0 5px;
            }
            .sp_P9ChxUVwaFx {
            background-image: url("/assets/images/icons/on.png");
            background-size: auto;
            background-repeat: no-repeat;
            display: inline-block;
            height: 12px;
            width: 12px;
            }
            .sp_P9ChxUVwaFx.sx_74fd99 {
            background-position: -300px -5px;
            }
            ._cbnm{
            float: left;
            padding-left: 10px;
            }

            .ec{
                cursor: pointer;
            }
            .emoticon {
                width: 22px;
                height: 22px;
                display: inline-block;
                vertical-align: top;
            }
            .emoji-list.emoticon {
                width: 21px !important;
                height: 22px;
                display: inline-block;
                vertical-align: top;
            }
            .emoticon_smile {
                background-image: url(/assets/chat/emoji.png);
                background-repeat: no-repeat;
                background-size: 600px;
                background-position: -576px -831px;
            }
            .emoticon_frown {
                background-image: url(/assets/chat/emoji.png);
                background-repeat: no-repeat;
                background-size: 600px;
                background-position: -576px -810px;
            }
            .emoticon_bsmile {
                background-image: url(/assets/chat/emoji.png);
                background-repeat: no-repeat;
                background-size: 600px;
                background-position: -555px -363px;
            }
            .emoticon_heart,.emoticon_heart2,.emoticon_heart3 {
                background-image: url(/assets/chat/emoji.png);
                background-repeat: no-repeat;
                background-size: 600px;
                background-position: -425px -170px;
            }
            .emoticon_tongue {
                background-image: url(/assets/chat/emoji.png);
                background-repeat: no-repeat;
                background-size: 600px;
                background-position: -576px 0;
            }
            .emoticon_wtongue {
                background-image: url(/assets/chat/emoji.png);
                background-repeat: no-repeat;
                background-size: 600px;
                background-position: -576px -21px;
            }
            .emoticon_kiss {
                background-image: url(/assets/chat/emoji.png);
                background-repeat: no-repeat;
                background-size: 600px;
                background-position: -555px -831px;
            }
            .emoticon_kiss_heart {
                background-image: url(/assets/chat/emoji.png);
                background-repeat: no-repeat;
                background-size: 600px;
                background-position: -555px -810px;
            }
            .emoticon_kiss_shy {
                background-image: url(/assets/chat/emoji.png);
                background-repeat: no-repeat;
                background-size: 600px;
                background-position: -555px -853px;
            }
            .emoticon_cool {
                background-image: url(/assets/chat/emoji.png);
                background-repeat: no-repeat;
                background-size: 600px;
                background-position: -555px -597px;
            }
            .emoticon_heye {
                background-image: url(/assets/chat/emoji.png);
                background-repeat: no-repeat;
                background-size: 600px;
                background-position: -555px -575px;
            }
            .emoticon_er {
                background-image: url(/assets/chat/emoji.png);
                background-repeat: no-repeat;
                background-size: 600px;
                background-position: -555px -618px;
            }
            .emoticon_cah {
                background-image: url(/assets/chat/emoji.png);
                background-repeat: no-repeat;
                background-size: 600px;
                background-position: -576px -682px;
            }        
            .emoticon_ldi {
                background-image: url(/assets/chat/emoji.png);
                background-repeat: no-repeat;
                background-size: 600px;
                background-position: -576px -85px;
            }
            .emoticon_di {
                background-image: url(/assets/chat/emoji.png);
                background-repeat: no-repeat;
                background-size: 600px;
                background-position: -576px -64px;
            }
            .emoticon_adi {
                background-image: url(/assets/chat/emoji.png);
                background-repeat: no-repeat;
                background-size: 600px;
                background-position: -576px -106px;
            }
            .emoticon_ev {
                background-image: url(/assets/chat/emoji.png);
                background-repeat: no-repeat;
                background-size: 600px;
                background-position: -555px -468px;
            }
            .emoticon_aev {
                background-image: url(/assets/chat/emoji.png);
                background-repeat: no-repeat;
                background-size: 600px;
                background-position: -576px -127px;
            }
            .emoticon_sadt {
                background-image: url(/assets/chat/emoji.png);
                background-repeat: no-repeat;
                background-size: 600px;
                background-position: -576px -149px;
            }
            .emoticon_ssp {
                background-image: url(/assets/chat/emoji.png);
                background-repeat: no-repeat;
                background-size: 600px;
                background-position: -576px -468px;
            }
            .emoticon_lsp {
                background-image: url(/assets/chat/emoji.png);
                background-repeat: no-repeat;
                background-size: 600px;
                background-position: -576px -490px;
            }
            .emoticon_zz {
                background-image: url(/assets/chat/emoji.png);
                background-repeat: no-repeat;
                background-size: 600px;
                background-position: -576px -532px;
            }
            .emoticon_wink {
                background-image: url(/assets/chat/emoji.png);
                background-repeat: no-repeat;
                background-size: 600px;
                background-position: -555px -490px;
            }
            .emoticon_angel {
                background-image: url(/assets/chat/emoji.png);
                background-repeat: no-repeat;
                background-size: 600px;
                background-position: -555px -447px;
            }
            .emoticon_blaugh {
                background-image: url(/assets/chat/emoji.png);
                background-repeat: no-repeat;
                background-size: 600px;
                background-position: -555px -426px;
            }
            .emoticon_tlaugh {
                background-image: url(/assets/chat/emoji.png);
                background-repeat: no-repeat;
                background-size: 600px;
                background-position: -555px -405px;
            }
            .emoticon_dtlaugh {
                background-image: url(/assets/chat/emoji.png);
                background-repeat: no-repeat;
                background-size: 600px;
                background-position: -555px -341px;
            }
            .emoticon_ectongue {
                background-image: url(/assets/chat/emoji.png);
                background-repeat: no-repeat;
                background-size: 600px;
                background-position: -576px -42px;
            }
            .emoticon_shyang {
                background-image: url(/assets/chat/emoji.png);
                background-repeat: no-repeat;
                background-size: 600px;
                background-position: -576px -170px;
            }
            .emoticon_anst {
                background-image: url(/assets/chat/emoji.png);
                background-repeat: no-repeat;
                background-size: 600px;
                background-position: -576px -192px;
            }
            .emoticon_sick {
                background-image: url(/assets/chat/emoji.png);
                background-repeat: no-repeat;
                background-size: 600px;
                background-position: -576px -597px;
            }
            .emoticon_tonguel {
                background-image: url(/assets/chat/emoji.png);
                background-repeat: no-repeat;
                background-size: 600px;
                background-position: -555px -533px;
            } 
            #da{
                padding-right: 15px;
            }
            .imgemo{
                content:url("data:image/png;base64,R0lGODlhFAAUAIAAAP///wAAACH5BAEAAAAALAAAAAAUABQAAAIRhI+py+0Po5y02ouz3rz7rxUAOw==");
            }
            ._53io {
                background-image: url(/assets/chat/2.png);
                background-repeat: no-repeat;
                background-size: auto;
                background-position: -143px -392px;
                bottom: -8px;
                height: 8px;
                width: 16px;
            }
            ._53io {
                overflow: hidden;
                position: absolute;
            }
            .unselectable {
                -webkit-touch-callout: none;
                -webkit-user-select: none;
                -khtml-user-select: none;
                -moz-user-select: none;
                -ms-user-select: none;
                user-select: none;
            }
            .ui-resizable-helper { border: 1px dotted #00F;
            }
            .ui-resizable-handle {
                background-color: transparent;
                width: 100%;
            }
            .ui-resizable-se {
              bottom: -5px;
              right: -5px;
            }
            .button, .rectangle {
              background: url(http://pic.52mxp.com/site/tool/line-h.png) top repeat-x,url(http://pic.52mxp.com/site/tool/line-h.png) bottom repeat-x,url(http://pic.52mxp.com/site/tool/line-v.png) left repeat-y,url(http://pic.52mxp.com/site/tool/line-v.png) right repeat-y;
            }
            .button {
              box-shadow: 3px 3px 0 rgba(0,0,0,0.5)!important;
            }
            .ui-resizable-n {
                left: 0;
            }
            .inner-chat-wrapper{
                overflow:scroll;
            }
            /*==========  Non-Mobile First Method  ==========*/

            /* Large Devices, Wide Screens */
            @media only screen and (max-width : 1200px) {
                #ruler{
                    width: 1200px;
                }
            }

            /* Medium Devices, Desktops */
            @media only screen and (max-width : 992px) {

            }

            /* CUS */
            @media only screen and (max-width : 870px) {
                .ctabs {
                    bottom: 319px;
                    direction: ltr;
                    height: 28px;
                    left: 0;
                    position: fixed;
                    right: 285px;
                }
                .tcvis{
                    bottom: 280px !important;
                    height: 28px !important;
                    right: 285px !important;
                    z-index: 7 !important;
                    opacity: 1 !important;
                }

            }
            /* Small Devices, Tablets */
            @media only screen and (max-width : 768px) {

            }
            /* Extra Small Devices, Phones */ 
            @media only screen and (max-width : 586px) {
                #ew1{
                    width: 97%;
                }
                /*ALL CHILD TABS*/
                .ctabs {
                    right: 0 !important;
                    opacity: 0.8;
                }
                /*THE MAIN DOC*/
                .dock-max {
                    direction: ltr;
                    height: 28px;
                    left: 0;
                    position: fixed;
                    right: 0;
                    opacity: 0.8;
                }
                /*SECOND CHILD TAB*/
                .dock-max-2 {
                    bottom: 319px;
                    direction: ltr;
                    height: 28px;
                    left: 0;
                    position: fixed;
                    right: 0;
                }
                ._dock {
                    margin: 0;
                }
                ._4mq3.wpNub, ._4mq3.wpNub.openToggler {
                    margin-left: 0;
                    margin-right: 0;
                }
                ._4mq3 {
                    width: 100%;
                }
                .nubContainer>div, ._dock {
                    width: 100%;
                }
                ._dock .rNubContainer {
                    width: 100%;
                }
                .wpNubButton-max-main {
                    height: 386px;
                }
                ._4mq3 .wpNubButton-max {
                    border-left: none;
                    border-radius: 0;
                    border-right: none;
                }
            }

            /* Extra Small Devices, Phones */ 
            @media only screen and (max-width : 480px) {

            }

            /* Custom, iPhone Retina */ 
            @media only screen and (max-width : 320px) {
                
            }
            /* Custom, iPhone Retina */ 
            @media only screen and (max-height : 512px) {
                .dock-max-height{
                    bottom: 295px;
                }
            }
            @media only screen and (max-height : 511px) {

            }
            @media only screen and (max-height : 300px) {
                .dock-max-height{
                    bottom: 165px;
                }
            }
        </style>
        <input type="hidden" id="tua1" value="{!!$uip9!!}">
        @if(Auth::check())
        <input type="hidden" id="ruler" >
        <input type="hidden" id="crnt_dt" value="{!!$cdt!!}"></input>
        <input type="hidden" id="ufh" value="{{Auth::user()->id}}"></input>
        <div id="msgs_tmp"></div>
        <div class="chat_dock">
            <div class="dock_wrapper dock-min dockWrapperRight main-list-dock" type="0">
                <div class="_dock m_clearfix">
                    <div class="m_clearfix nubContainer rNubContainer">
                        <div id="BuddylistPagelet">
                            <div class="_56ox ">
                                <div class="uiToggle _50-v wpNub _4mq3 hide_on_presence_error" id="wpDockChatBuddylistNub">
                                    <div class="wpNubButton pointer nm">
                                        <span class="label nb-lb unselectable">Chat</span>
                                        <span class="have-msg nb-lb hide"><i class="fa fa-envelope-o"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div  id="mtab" class="dock_wrapper dock-max-height dock-max dockWrapperRight hide tvis" type="1">
                <div class="_dock m_clearfix resizable ">
                    <div class="m_clearfix nubContainer rNubContainer">
                        <div id="BuddylistPagelet">
                            <div class="_56ox ">
                                <div class="uiToggle-m _50-v wpNub _4mq3 hide_on_presence_error" id="wpDockChatBuddylistNub">
                                    <div class="wpNubButton-max wpNubButton-max-main">
                                        <div class="ui-resizable-handle ui-resizable-n"></div>
                                        <span class="label nb-lb lb-m pointer dts unselectable">
                                        Chat
                                            <span id="da" class="pull-right">
                                                <i class="glyphicon glyphicon-triangle-bottom"></i>
                                            </span>
                                        </span>

                                        <div class="unselectable" id="inner-chat-wrapper">
                                            {!!$friends_list!!}
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="chat_dockChilds">
            <div id="ctab1" class="ctabs dc1 dock_wrapperChilds dock-max-1 dockWrapperRightChilds hide" dock-no="1" type="1" uid="">
                <div class="_dock m_clearfix">
                    <div class="m_clearfix nubContainer rNubContainer">
                        <div id="BuddylistPagelet">
                            <div class="_56ox ">
                                <div class="uiToggle-m _50-v wpNub _4mq3 hide_on_presence_error" id="wpDockChatBuddylistNub">
                                    <div class="wpNubButton-max">
                                        
                                        <span class="label nb-lb lb-m pointer ">
                                            <span class="_cbnm _cbnm1 dtsc"></span> 
                                            <span class="cc1 ChatClose pull-right"><i class="fa fa-times"></i></span>
                                        </span>
                                        <div class="sc-wrapper sc-wrapper-1"></div>
                                        <div class="inputBar">
                                            <div id="ew1" class="hide">
                                                <div id="el1ew" class="el1 unselectable">
                                                    <i tab="1" echar=":)" txt="smile" class="ec emoticon emoticon_smile"></i>
                                                    <i tab="1" echar=":(" txt="frown" class="ec emoticon emoticon_frown"></i>
                                                    <i tab="1" echar=":d" txt="bsmile" class="ec emoticon emoticon_bsmile"></i>
                                                    <i tab="1" echar="<3" txt="heart" class="ec emoticon emoticon_heart"></i>
                                                    <i tab="1" echar=":p" txt="tongue" class="ec emoticon emoticon_tongue"></i>
                                                    <i tab="1" echar=":)''" txt="dtlaugh" class="ec emoticon emoticon_dtlaugh"></i>
                                                    <i tab="1" echar=":)'" txt="tlaugh" class="ec emoticon emoticon_tlaugh"></i>
                                                    <i tab="1" echar=":))" txt="blaugh" class="ec emoticon emoticon_blaugh"></i>
                                                    <i tab="1" echar="#:)" txt="angel" class="ec emoticon emoticon_angel"></i>
                                                    <i tab="1" echar=";)" txt="wink" class="ec emoticon emoticon_wink"></i>
                                                    <i tab="1" echar="-z:)" txt="zz" class="ec emoticon emoticon_zz"></i>
                                                    <i tab="1" echar=":ad|" txt="adi" class="ec emoticon emoticon_adi"></i>
                                                    <i tab="1" echar="o0" txt="lsp" class="ec emoticon emoticon_lsp"></i>
                                                    <i tab="1" echar="o0|" txt="ssp" class="ec emoticon emoticon_ssp"></i>
                                                    <i tab="1" echar=":'(" txt="sadt" class="ec emoticon emoticon_sadt"></i>
                                                    <i tab="1" echar=":/^" txt="aev" class="ec emoticon emoticon_aev"></i>
                                                    <i tab="1" echar=":/^^" txt="ev" class="ec emoticon emoticon_ev"></i>
                                                    <i tab="1" echar=";s*" txt="kiss_shy" class="ec emoticon emoticon_kiss_shy"></i>
                                                    <i tab="1" echar=":h*"  txt="kiss_heart" class="ec emoticon emoticon_kiss_heart"></i>
                                                    <i tab="1" echar=":*" txt="kiss" class="ec emoticon emoticon_kiss"></i>
                                                    <i tab="1" echar=";p" txt="wtongue" class="ec emoticon emoticon_wtongue"></i>
                                                    <i tab="1" echar="::|" txt="ldi" class="ec emoticon emoticon_ldi"></i>
                                                    <i tab="1" echar=":hc:" txt="cah" class="ec emoticon emoticon_cah"></i>
                                                    <i tab="1" echar="<:3" txt="heye" class="ec emoticon emoticon_heye"></i>
                                                    <i tab="1" echar=":)-/" txt="er" class="ec emoticon emoticon_er"></i>
                                                    <i tab="1" echar="^c^" txt="cool" class="ec emoticon emoticon_cool"></i>
                                                    <i tab="1" echar="::P" txt="ectongue" class="ec emoticon emoticon_ectongue"></i>
                                                    <i tab="1" echar=")s:" txt="shyang" class="ec emoticon emoticon_shyang"></i>
                                                    <i tab="1" echar=":an|" txt="anst" class="ec emoticon emoticon_anst"></i>
                                                    <i tab="1" echar=":--:" txt="sick" class="ec emoticon emoticon_sick"></i>
                                                    <i tab="1" echar=":)p" txt="tonguel" class="ec emoticon emoticon_tonguel"></i>
                                                </div>
                                                    <i class="_53io" style="left: 100%; margin-left: -23px;"></i>
                                            </div>
                                            <div ttab="1" class="ChatTextArea" id="cta1" contenteditable="true" placeholder="Type Here..."></div>
                                            <div class="chatemoji">
                                                <i class="fa fa-smile-o emoi " id="emoi-1" aria-hidden="true"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="ctab2" class="ctabs dc2 dock_wrapperChilds dock-max-2 dockWrapperRightChilds hide" dock-no="2" type="1" uid="">
                <div class="_dock m_clearfix">
                    <div class="m_clearfix nubContainer rNubContainer">
                        <div id="BuddylistPagelet">
                            <div class="_56ox ">
                                <div class="uiToggle-m _50-v wpNub _4mq3 hide_on_presence_error" id="wpDockChatBuddylistNub">
                                    <div class="wpNubButton-max">
                                        <span class="label nb-lb lb-m pointer ">
                                            <span class="_cbnm _cbnm2 dtsc"></span> 
                                            <span class="cc2 ChatClose pull-right"><i class="fa fa-times"></i></span>
                                        </span>
                                        <div class="sc-wrapper sc-wrapper-2"></div>
                                        <div class="inputBar">
                                            <div id="emoji-list-2" class="emoji-list hide"></div>
                                            <div class="ChatTextArea" ttab="2" id="cta2" contenteditable="true"></div>
                                            <div class="chatemoji">
                                                <i class="fa fa-smile-o emoi " id="emoi-2" aria-hidden="true"></i>
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
        <div class="hide" id="ex1" contenteditable="true"></div>
        <div class="hide" id="ex2" contenteditable="true"></div>
        
            <script src="https://cdn.socket.io/socket.io-1.3.5.js"></script>
            <script>
                //var socket = io('http://localhost:3000');
                window.socket = io('http://202.168.154.181:3000');
                socket.emit("_init", { data: "{!!Auth::id()!!}" });
            </script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/marked/0.3.5/marked.min.js"></script>
            <script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/8.4/highlight.min.js"></script>
            <script src="//platform.twitter.com/widgets.js"></script>
            <script src="http://vjs.zencdn.net/5.0.0/video.js"></script>
            <script src="https://cdn.jsdelivr.net/prism/1.4.1/prism.js"></script>
            <script src="/assets/js/chat.js"></script>
        @endif
