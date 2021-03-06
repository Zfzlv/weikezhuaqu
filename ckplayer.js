/*
-------------------------------------------------------------------------
  说明:
  正式使用时可以把该文件的注释全部去掉，节省加载时间
  ckplayer6.5,有问题请访问http://www.ckplayer.com
  请注意，该文件为UTF-8编码，不需要改变编码即可使用于各种编码形式的网站内	
-------------------------------------------------------------------------
第一部分，加载插件
以下为加载的插件部份
插件的设置参数说明：
	1、插件名称
	2、水平对齐方式（0左，1中，2右）
	3、垂直对齐方式（0上，1中，2下）
	4、水平方向位置偏移量
	5、垂直方向位置偏移量
	6、插件的等级，0=普通图片插件且跟随控制栏隐藏而隐藏，显示而显示，1=普通图片插件且永久显示，2=swf插件，默认显示，3=swf插件，默认隐藏，swf插件都可以交互
	7、插件是否绑定在控制栏上，0不绑定，1绑定，当值是1的时候该插件将会随着控制栏一起隐藏或缓动
	8、插件为swf并且可交互时，默认调用的类所在的包名称，详细说明可以到帮助手册里查看，默认无
	插件名称不能相同，对此的详细说明请到网站查看
*/
function ckcpt() {
    var cpt = '';
  //  cpt += 'right.swf,2,1,0,0,2,0|'; //右边开关灯，调整，分享按钮的插件
  //// cpt += 'share.swf,1,1,-180,-100,3,0|'; //分享插件
   // cpt += 'adjustment.swf,1,1,-180,-100,3,0|'; //调整大小和颜色的插件
    return cpt;
}
/*
插件的定义结束
以下是对播放器功能进行配置
*/
function ckstyle() { //定义总的风格
    var ck = {
        cpath: '',
        /*
		播放器风格压缩包文件的路径，默认的是style.swf
		如果调用不出来可以试着设置成绝对路径试试
		如果不知道路径并且使用的是默认配置，可以直接留空，播放器会
		*/
        language: '',
        /*播放器所使用的语言配置文件，需要和播放器在同目录下，默认是language.xml*/
        flashvars: '',
        /*
		这里是用来做为对flashvars值的补充，除了c和x二个参数以外的设置都可以在这里进行配置
		                          1 1 1 1   1 1 1 1 1 1 2 2 2  2 2 2 2 2    2 2 3 3 3 3 3 3 3 3 3   3 4
       			1 2 3 4 5 6 7 8 9 0 1 2 3   4 5 6 7 8 9 0 1 2  3 4 5 6 7    8 9 0 1 2 3 4 5 6 7 8   9 0*/
        setup: '1,1,1,1,1,2,0,1,2,0,0,1,200,0,2,1,0,1,1,1,2,10,3,0,1,2,3000,0,0,0,0,1,1,1,1,1,1,250,0,90',
        /*
		这是配置文件里比较重要的一个参数，共有N个功能控制参数，并且以后会继续的增加，各控制参数以英文逗号(,)隔开。下面列出各参数的说明：
			1、鼠标经过按钮是否使用手型，0普通鼠标，1手型鼠标，2是只有按钮手型，3是控制栏手型
			2、是否支持单击暂停，0不支持，1是支持
			3、是否支持双击全屏，0不支持，1是支持
			4、在播放前置广告时是否同时加载视频，0不加载，1加载
			5、广告显示的参考对象，0是参考视频区域，1是参考播放器区域
			6、广告大小的调整方式,只针对swf和图片有效,视频是自动缩放的
				=0是自动调整大小，意思是说大的话就变小，小的话就变大
				=1是大的化变小，小的话不变
				=2是什么也不变，就这么大
				=3是跟参考对像(第5个控制)参数设置的一样宽高
			7、前置广告播放顺序，0是顺序播放，1是随机播放，>1则随机取所有广告中的(N-1)个进行播放
			8、对于视频广告是否采用修正，0是不使用，1是使用，如果是1，则用户在网速慢的情况下会按设定的倒计时进行播放广告，计时结束则放正片（比较人性化），设置成0的话，则强制播放完广告才能播放正片
			9、是否开启滚动文字广告，0是不开启，1是开启且不使用关闭按钮，2是开启并且使用关闭按钮，开启后将在加载视频的时候加载滚动文字广告
			10、视频的调整方式
				=0是自动调整大小，意思是说大的话就变小，小的话就变大，同时保持长宽比例不变
				=1是大的化变小，小的话不变
				=2是什么也不变，就这么大
				=3是跟参考对像(pm_video的设置)参数设置的一样宽高
			11、是否在多视频时分段加载，0不是，1是
			12、缩放视频时是否进行平滑处理，0不是，1是
			13、视频缓冲时间,单位：毫秒,建议不超过300
			14、初始图片调整方式(
				=0是自动调整大小，意思是说大的话就变小，小的话就变大，同时保持长宽比例不变
				=1是大的化变小，小的话不变
				=2是什么也不变，就这么大
				=3是跟pm_video参数设置的一样宽高
			15、暂停广告调整方式(
				=0是自动调整大小，意思是说大的话就变小，小的话就变大，同时保持长宽比例不变
				=1是大的化变小，小的话不变
				=2是什么也不变，就这么大
				=3是跟pm_video参数设置的一样宽
			16、暂停广告是否使用关闭广告设置，0不使用，1使用
			17、缓冲时是否播放广告，0是不显示，1是显示并同时隐藏掉缓冲图标和进度，2是显示并不隐藏缓冲图标
			18、是否支持键盘空格键控制播放和暂停0不支持，1支持
			19、是否支持键盘左右方向键控制快进快退0不支持，1支持
			20、是否支持键盘上下方向键控制音量0不支持，1支持
			21、播放器返回js交互函数的等级，0-2,等级越高，返回的参数越多
				0是返回少量常用交互
				1返回播放器在播放的时候的参数，不返回广告之类的参数
				2返回全部参数
				3返回全部参数，并且在参数前加上"播放器ID->"，用于多播放器的监听
			22、快进和快退的秒数
			23、界面上图片元素加载失败重新加载次数
			24、开启加载皮肤压缩文件包的加载进度提示
			25、使用隐藏控制栏时显示简单进度条的功能,0是不使用，1是使用，2是只在普通状态下使用
			26、控制栏隐藏设置(0不隐藏，1全屏时隐藏，2都隐藏
			27、控制栏隐藏延时时间，即在鼠标离开控制栏后多少毫秒后隐藏控制栏
			28、左右滚动时是否采用无缝，默认0采用，1是不采用
			29、0是正常状态，1是控制栏默认隐藏，播放状态下鼠标经过播放器显示控制栏，2是一直隐藏控制栏
			30、在播放rtmp视频时暂停后点击播放是否采用重新链接的方式,这里一共分0-2三个等级
			31、当采用网址形式(flashvars里s=1/2时)读取视频地址时是采用默认0=get方法，1=post方式
			32、是否启用播放按钮和暂停按钮
			33、是否启用中间暂停按钮
			34、是否启用静音按钮
			35、是否启用全屏按钮
			36、是否启用进度调节栏
			37、是否启用调节音量
			38、计算时间的间隔，毫秒
			39、前置logo至少显示的时间，单位：毫秒
			40、前置视频广告的默认音量
		*/
        pm_bg: '0x000000,100,230,180',
        /*播放器整体的背景配置，请注意，这里只是一个初始化的设置，如果需要真正的改动播放器的背景和最小宽高，需要在风格文件里找到相同的参数进行更改。
		1、整体背景颜色
		2、背景透明度
		3、播放器最小宽度
		4、播放器最小高度
		这里只是初始化时的设置，最终加载完播放器后显示的效果需要在style.swf/style.xml里设置该参数
		*/
        mylogo: 'null',
        /*
		视频加载前显示的logo文件，不使用设置成null，即ck.mylogo='null';
		*/
        pm_mylogo: '1,1,-100,-55',
        /*
		视频加载前显示的logo文件(mylogo参数的)的位置
		本软件所有的四个参数控制位置的方式全部都是统一的意思，如下
			1、水平对齐方式，0是左，1是中，2是右
			2、垂直对齐方式，0是上，1是中，2是下
			3、水平偏移量，举例说明，如果第1个参数设置成0左对齐，第3个偏移量设置成10，就是离左边10个像素，第一个参数设置成2，偏移量如果设置的是正值就会移到播放器外面，只有设置成负值才行，设置成-1，按钮就会跑到播放器外面
			4、垂直偏移量 
		*/
        logo: 'null',
        /*
		默认右上角一直显示的logo，不使用设置成null，即ck.logo='null';
		*/
        pm_logo: '2,0,-100,20',
        /*
		播放器右上角的logo的位置
			1、水平对齐方式，0是左，1是中，2是右
			2、垂直对齐方式，0是上，1是中，2是下
			3、水平偏移量
			4、垂直偏移量 
		以下是播放器自带的二个插件
		*/
        control_rel: 'related.swf,ckplayer/related.xml,0',
        /*
		视频结束显示精彩视频的插件
			1、视频播放结束后显示相关精彩视频的插件文件（注意，视频结束动作设置成3时(即var flashvars={e:3})有效），
			2、xml文件是调用精彩视频的示例文件，可以自定义文件类型（比如asp,php,jsp,.net只要输出的是xml格式就行）,实际使用中一定要注意第二个参数的路径要正确
			3、第三个参数是设置配置文件的编码，0是默认的utf-8,1是gbk2312 
		*/
        control_pv: 'Preview.swf,105,2000',
        /*
		视频预览插件
			1、插件文件名称(该插件和上面的精彩视频的插件都是放在风格压缩包里的)
			2、离进度栏的高(指的是插件的顶部离进度栏的位置)
			3、延迟时间(该处设置鼠标经过进度栏停顿多少毫秒后才显示插件)
			建议一定要设置延时时间，不然当鼠标在进度栏上划过的时候就会读取视频地址进行预览，很占资源 
		*/
        pm_repc: 'it736->video.dearedu.com',
		/*
		视频地址替换符，该功能主要是用来做简单加密的功能，使用方法很简单，请注意，只针对f值是视频地址的时候有效，其它地方不能使用。具体的请查看http://www.ckplayer.com/manual.php?id=4#title_25
		*/
        pm_spac: '|',
        /*
		视频地址间隔符，这里主要是播放多段视频时使用普通调用方式或网址调用方式时使用的。默认使用|，如果视频地址里本身存在|的话需要另外设置一个间隔符，注意，即使只有一个视频也需要设置。另外在使用rtmp协议播放视频的时候，如果视频存在多级目录的话，这里要改成其它的符号，因为rtmp协议的视频地址多级的话也需要用到|隔开流地址和实例地址 
		*/
        pm_fpac: 'file->f',
        /*
		该参数的功能是把自定义的flashvars里的变量替换成ckplayer里对应的变量，默认的参数的意思是把flashvars里的file值替换成f值，因为ckplayer里只认f值，多个替换之间用竖线隔开
		*/
        pm_advtime: '2,0,-110,10,0,300,0',
        /*
		前置广告倒计时文本位置，播放前置 广告时有个倒计时的显示文本框，这里是设置该文本框的位置和宽高，对齐方式的。一共7个参数，分别表示：
			1、水平对齐方式，0是左对齐，1是中间对齐，2是右对齐
			2、垂直对齐方式，0是上对齐，1是中间对齐，2是低部对齐
			3、水平位置偏移量
			4、垂直位置偏移量
			5、文字对齐方式，0是左对齐，1是中间对齐，2是右对齐，3是默认对齐
			6、文本框宽席
			7、文本框高度 
		*/
        pm_advstatus: '1,2,2,-200,-40',
        /*
		前置广告静音按钮，静音按钮只在是视频广告时显示，当然也可以控制不显示 
			1、是否显示0不显示，1显示
			2、水平对齐方式
			3、垂直对齐方式
			4、水平偏移量
			5、垂直偏移量
		*/
        pm_advjp: '1,1,2,2,-100,-40',
        /*
		前置广告跳过广告按钮的位置
			1、是否显示0不显示，1是显示
			2、跳过按钮触发对象(值0/1,0是直接跳转,1是触发js:function ckadjump(){})
			3、水平对齐方式
			4、垂直对齐方式
			5、水平偏移量
			6、垂直偏移量
		*/
        pm_padvc: '2,0,-10,-10',
        /*
		暂停广告的关闭按钮的位置
			1、水平对齐方式
			2、垂直对齐方式
			3、水平偏移量
			4、垂直偏移量
		*/
        pm_advms: '2,2,-46,-56',
        /*
		滚动广告关闭按钮位置
			1、水平对齐方式
			2、垂直对齐方式
			3、水平偏移量
			4、垂直偏移量
		*/
        pm_zip: '1,1,-20,-8,1,0,0',
        /*
		加载皮肤压缩包时提示文字的位置
			1、水平对齐方式，0是左对齐，1是中间对齐，2是右对齐
			2、垂直对齐方式，0是上对齐，1是中间对齐，2是低部对齐
			3、水平位置偏移量
			4、垂直位置偏移量
			5、文字对齐方式，0是左对齐，1是中间对齐，2是右对齐，3是默认对齐
			6、文本框宽席
			7、文本框高度
		*/
        //pm_advmarquee: '1,2,50,-60,50,18,0,0x000000,50,0,20,1,15,2000',
		pm_advmarquee: '1,2,50,-60,50,20,0,0x000000,50,0,20,1,30,2000',
        /*
		滚动广告的控制，要使用的话需要在setup里的第9个参数设置成1
		这里分二种情况,前六个参数是定位控制，第7个参数是设置定位方式(0：相对定位，1：绝对定位)
		第一种情况：第7个参数是0的时候，相对定位，就是播放器长宽变化的时候，控制栏也跟着变
			1、默认1:中间对齐
			2、上中下对齐（0是上，1是中，2是下）
			3、离左边的距离
			4、Y轴偏移量
			5、离右边的距离
			6、高度
			7、定位方式
		第二种情况：第7个参数是1的时候，绝对定位，就是播放器长宽变化的时候，控制栏不跟着变，这种方式一般使用在控制栏大小不变的时候
			1、左中右对齐方式（0是左，1是中间，2是右）
			2、上中下对齐（0是上，1是中，2是下）
			3、x偏移量
			4、y偏移量
			5、宽度
			6、高度
			7、定位方式
		以上是前7个参数的作用
			8、是文字广告的背景色
			9、置背景色的透明度
			10、控制滚动方向，0是水平滚动（包括左右），1是上下滚动（包括向上和向下）
			11、移动的单位时长，即移动单位像素所需要的时长，毫秒
			12、移动的单位像素,正数同左/上，负数向右/下
			13、是行高，这个在设置向上或向下滚动的时候有用处
			14、控制向上或向下滚动时每次停止的时间
		*/
		pm_glowfilter:'1,0x01485d, 100, 6, 3, 10, 1, 0, 0',
		/*滚动文字广告是否采用发光滤镜
			1、是否使用发光滤镜，0是不采用，1是使用
			2、(default = 0xFF0000) — 光晕颜色，采用十六进制格式 0xRRGGBB。 默认值为 0xFF0000  
			3、(default = 100) — 颜色的 Alpha 透明度值。 有效值为 0 到 100。 例如，25 设置透明度为 25%
			4、(default = 6.0) — 水平模糊量。 有效值为 0 到 255（浮点）。 2 的乘方值（如 2、4、8、16 和 32）经过优化，呈现速度比其它值更快  
			5、(default = 6.0) — 垂直模糊量。 有效值为 0 到 255（浮点）。 2 的乘方值（如 2、4、8、16 和 32）经过优化，呈现速度比其它值更快  
			6、(default = 2) — 印记或跨页的强度。 该值越高，压印的颜色越深，而且发光与背景之间的对比度也越强。 有效值为 0 到 255  
			7、(default = 1) — 应用滤镜的次数
			8、(default = 0) — 指定发光是否为内侧发光。 值 1 指定发光是内侧发光。 值 0 指定发光是外侧发光（对象外缘周围的发光）  
			9、(default = 0) — 指定对象是否具有挖空效果。 值为 1 将使对象的填充变为透明，并显示文档的背景颜色 
		*/
        advmarquee: escape(''),
        /*
		该处是滚动文字广告的内容，如果不想在这里设置，就把这里清空并且在页面中使用js的函数定义function ckmarqueeadv(){return '广告内容'}
		*/
		mainfuntion:'',
		/*
		当flashvars里s=3/4时，调用的函数包名称，默认为空，调用时间轴上的函数setAppObj
		*/
		flashplayer:'',
		/*
		当flashvars里的s=3/4时，也可以把swf文件放在这里
		*/
		calljs:'ckplayer_status,ckadjump,playerstop,ckmarqueeadv',
		/*
			跳过广告和播放结束时调用的js函数
		*/
        myweb: escape(''),
        /*
		------------------------------------------------------------------------------------------------------------------
		以下内容部份是和插件相关的配置，请注意，自定义插件以及其配置的命名方式要注意，不要和系统的相重复，不然就会替换掉系统的相关设置，删除相关插件的话也可以同时删除相关的配置
		------------------------------------------------------------------------------------------------------------------
		以下内容定义自定义插件的相关配置，这里也可以自定义任何自己的插件需要配置的内容，当然，如果你某个插件不使用的话，也可以删除相关的配置
		------------------------------------------------------------------------------------------------------------------
		*/
        cpt_lights: '1',
		/*
		该处定义是否使用开关灯，和right.swf插件配合作用,使用开灯效果时调用页面的js函数function closelights(){};
		*/
        cpt_share: 'ckplayer/share.xml',
        /*
		分享插件调用的配置文件地址
		调用插件开始
		*/
        cpt_list: ckcpt()
        /*
		ckcpt()是本文件最上方的定义插件的函数
		*/
    }
    return ck;
}



			var base64EncodeChars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/";
			var base64DecodeChars = new Array(
				-1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1,
				-1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1,
				-1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, 62, -1, -1, -1, 63,
				52, 53, 54, 55, 56, 57, 58, 59, 60, 61, -1, -1, -1, -1, -1, -1,
				-1,  0,  1,  2,  3,  4,  5,  6,  7,  8,  9, 10, 11, 12, 13, 14,
				15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, -1, -1, -1, -1, -1,
				-1, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36, 37, 38, 39, 40,
				41, 42, 43, 44, 45, 46, 47, 48, 49, 50, 51, -1, -1, -1, -1, -1);

			function base64encode(str) {
				var out, i, len;
				var c1, c2, c3;

				len = str.length;
				i = 0;
				out = "";
				while(i < len) {
					c1 = str.charCodeAt(i++) & 0xff;
					if(i == len)
					{
						out += base64EncodeChars.charAt(c1 >> 2);
						out += base64EncodeChars.charAt((c1 & 0x3) << 4);
						out += "==";
						break;
					}
					c2 = str.charCodeAt(i++);
					if(i == len)
					{
						out += base64EncodeChars.charAt(c1 >> 2);
						out += base64EncodeChars.charAt(((c1 & 0x3)<< 4) | ((c2 & 0xF0) >> 4));
						out += base64EncodeChars.charAt((c2 & 0xF) << 2);
						out += "=";
						break;
					}
					c3 = str.charCodeAt(i++);
					out += base64EncodeChars.charAt(c1 >> 2);
					out += base64EncodeChars.charAt(((c1 & 0x3)<< 4) | ((c2 & 0xF0) >> 4));
					out += base64EncodeChars.charAt(((c2 & 0xF) << 2) | ((c3 & 0xC0) >>6));
					out += base64EncodeChars.charAt(c3 & 0x3F);
				}
				return out;
			}
			function guolv(str) {
				var c1, c2, c3, c4;
				var i, len, out;

				len = str.length;
				i = 0;
				out = "";
				while(i < len) {
					/* c1 */
					do {
						c1 = base64DecodeChars[str.charCodeAt(i++) & 0xff];
					} while(i < len && c1 == -1);
					if(c1 == -1)
						break;

					/* c2 */
					do {
						c2 = base64DecodeChars[str.charCodeAt(i++) & 0xff];
					} while(i < len && c2 == -1);
					if(c2 == -1)
						break;

					out += String.fromCharCode((c1 << 2) | ((c2 & 0x30) >> 4));

					/* c3 */
					do {
						c3 = str.charCodeAt(i++) & 0xff;
						if(c3 == 61)
							return out;
						c3 = base64DecodeChars[c3];
					} while(i < len && c3 == -1);
					if(c3 == -1)
						break;

					out += String.fromCharCode(((c2 & 0XF) << 4) | ((c3 & 0x3C) >> 2));

					/* c4 */
					do {
						c4 = str.charCodeAt(i++) & 0xff;
						if(c4 == 61)
							return out;
						c4 = base64DecodeChars[c4];
					} while(i < len && c4 == -1);
					if(c4 == -1)
						break;
					out += String.fromCharCode(((c3 & 0x03) << 6) | c4);
				}
				return out;
			}