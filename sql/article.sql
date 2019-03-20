-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- 主機: 127.0.0.1
-- 產生時間： 2019 年 03 月 20 日 08:17
-- 伺服器版本: 10.1.37-MariaDB
-- PHP 版本： 7.1.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `movie`
--

-- --------------------------------------------------------

--
-- 資料表結構 `article`
--

CREATE TABLE `article` (
  `sid` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  `avatar` varchar(255) DEFAULT NULL COMMENT '作者頭像',
  `date` varchar(255) DEFAULT NULL,
  `content` text NOT NULL,
  `image` varchar(255) DEFAULT NULL COMMENT '圖檔名',
  `link` text COMMENT '外部連結欄位'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 資料表的匯出資料 `article`
--

INSERT INTO `article` (`sid`, `title`, `author`, `avatar`, `date`, `content`, `image`, `link`) VALUES
(1, '玩具總動員4預告片曝！ 牧羊女大變身', '胡迪', '', '2019-03-16', '<p>皮克斯招牌動畫「玩具總動員」系列卡通，今年暑假，即將再推出第4集，現在正式預告片也出爐了，消失一集的牧羊女，重新回歸，但形象跟以往很不一樣，呈現獨立、幹練形象，除了卡通片，彭于晏主演的新片，這回挑戰新的角色，擔任救援隊成員，除了要跳機還面臨許多爆破場景，據了解劇組還特別請來好萊塢團隊，花費約32.2億台幣打造而成。</p>', 'test2.jpg', ''),
(2, '《冰與火之歌：權力遊戲》渡鴉、龍飛太快？第八季更注重時間邏輯！', '艾蜜莉亞·克拉克', '', '2019-03-21', '<p>2017年《冰與火之歌：權力遊戲》（Game of Thrones）播出第七季，首次減少為7集，而不是往年的10集，所以故事進度神速，「瑟曦蘭尼斯特」與「攸倫葛雷喬伊」組同盟，「珊莎史塔克」、「布蘭史塔克」與妹妹「艾莉亞史塔克」重聚後對付小指頭、「瓊恩雪諾」與「丹妮莉絲坦格利安」不只聯手還戀愛了，夜王得到異鬼龍，把絕境長城炸破一個洞，劇情節奏跟前幾季比，可說是緊湊到不可思議，許多角色在廣闊的維斯特洛大地快速穿梭，讓許多觀眾討論和吐槽，「詹德利」跑多快？渡鴉飛多快？龍飛多快？才能讓「丹妮莉絲」及時趕到長城外，去救被異鬼大軍包圍的「瓊恩雪諾」一行人？</p>\r\n<p>對於這些質疑，執行製作人 布萊恩考克曼（Bryan Cogman）接受《娛樂週刊》訪問時表示：「上一季我們做了決定，就是別管那麼多，觀眾可以坐在家裡算數學，算搭船從A到B會花多久時間？（指臨冬城到龍石島的距離時間）不管你們算多久，沒錯，就是多久，我想觀眾感到憤慨總比其他情緒好，所以我接受。」</p>\r\n<p>影集統籌DB Weiss補充說：「我們不會閱讀太多網上的批評，如果有人說：『我不喜歡你們的做法』我不知道這樣的觀眾佔多少百分比，即使這個意見在社群上討論熱烈，很可能是1%觀眾在社群上討論，10分鐘後，就變得不只1%了，我沒有興趣知道到底有多少觀眾實際上這麼想，因為當你開始思考，就會讓自己發瘋。」</p>\r\n<p>儘管製作人與影集統籌都表示不在意影迷的吐槽，不過編劇 戴夫希爾（Dave Hill）仍表示，尚未播出的第八季雖然只有六集，但應該不會讓觀眾產生相同的質疑，他說：「第八季有許多事情發生，為了故事的平衡，必須加快劇情速度，有很多時間刪減，其實是可以上字幕『三週過去了』，但我們沒有這樣做。第八季我們試圖保留更多時間邏輯，而不是給角色背上噴射背包。」</p>\r\n<p>《冰與火之歌：權力遊戲》第八季最後六集將於4月15日回歸HBO。</p>', 'test3.png', 'https://zh.wikipedia.org/wiki/%E6%9D%83%E5%8A%9B%E7%9A%84%E6%B8%B8%E6%88%8F_(%E7%94%B5%E8%A7%86%E5%89%A7)'),
(3, '迪士尼、福斯正式合併　《X戰警》確定回歸《復仇者》', '死特', '', '2019-03-20', '<p>歷史性的一刻！迪士尼、福斯於紐約時間20日凌晨12點02分（台灣時間20日中午12點02分）正式合併，好萊塢6大巨頭重新洗牌，未來福斯將成為迪士尼的子公司之一，而迪士尼握有福斯版權包括《X戰警》、《異形》、《阿凡達》、《辛普森家庭》等，全球票房佔有率將從30％提升至40％，一年賺進超過75億美金，「死侍」萊恩雷諾斯戴上「米老鼠帽」曬照紀念「換東家」的這一天。</p>\r\n<p>迪士尼以71億美金（約2188億台幣）收購福斯，於20日凌晨12點02分合併生效。迪士尼CEO羅伯特艾格（Robert Bob Iger）紐約時間19日下午發表聲明：「這對我們來說是一個非凡的歷史性時刻，將為我們公司和股東創造巨大的長期價值，結合迪士尼、福斯多元且創意內容、經驗豐富的人才，創造卓越的全球娛樂公司，有利於領導一個充滿活力和改變的時代。」同時，迪士尼強調，合併主要是幫助公司「增加其國際足跡」、「擴大直接面對消費者的產品」。</p>\r\n<p>迪士尼旗下包括迪士尼電影公司、迪士尼動畫工作室等，2006年起併購皮克斯工作室，2009年買下漫威娛樂，並在隔年成立漫威工作室，2012年買下《星際大戰》版權擁有者盧卡斯影業，如今福斯影片也成為迪士尼的子公司之一，未來迪士尼將握有福斯版權包括《死侍》、《X戰警》、《驚奇四超人》、《異形》、《阿凡達》、《猩球崛起》、《金牌特務》、《艾莉塔》等以及電視作品《辛普森家庭》、《X檔案》等。</p>', 'test4.jpg', ''),
(4, '驚奇隊長踹飛《突擊隊》全球狂賣235億', '尼克．福瑞', '', '2019-03-20', '<p>漫威超級英雄電影《驚奇隊長》（Captain Marvel）票房一飛衝天，不僅全台狂賣3億467萬元，蟬聯票房冠軍，全球累積至前天高達7.6億美元（約235.6億元台幣），超越《美國隊長2：酷寒戰士》、《奇異博士》、《自殺突擊隊》等超英片，外媒預測將《驚奇隊長》全球賣座上看10億美元（約310億元台幣）。</p>\r\n<p>金獎影后布麗拉森飾演的驚奇隊長也將在《復仇者聯盟4：終局之戰》對抗薩諾斯，上周五釋出的最新預告中也令「雷神索爾」認可「我喜歡這一位」，令影迷熱血沸騰。</p>\r\n<p>《復仇者4》下月登場</p>\r\n<p>《復仇者4》預告在24小時內創下2.68億次點閱，是繼去年12月首支預告的2.89億次，該片連霸史上首日點閱次數最高與次高紀錄，可見粉絲期待度破表。《復仇者4》下月24日在台上映。</p>', 'test5.jpg', ''),
(5, '宮崎駿多次「引退詐欺」 吉卜力資深製作人看不下去：請別再說自己要引退', '娜烏希卡', '', '2019-03-20', '<p>日本動畫大師宮崎駿在1986年完成長篇動畫《天空之城》後，至今宣佈過多達7次的引退宣言，不過從他目前在正製作第12部長篇動畫《你想活出怎樣的人生》的情況看來，先前的引退宣言已經是全數跳票。吉卜力工作室資深製片人鈴木敏夫於日前接受動畫新聞網（ANN）採訪時表示「完全不相信宮崎駿的引退宣言」，他認為宮崎駿是一個不可能退休的人，未來也肯定會「不斷的畫下去」。</p>\r\n<p>從1986到2013共提出了7次的引退宣言，最後一次便是在《風起》推出後，而這也是最慎重的一次。不過，歷經短暫的休息，宮崎駿仍是閒不下來，隨即又在2015年以首次的CG電腦繪圖推出構思已久的動畫短片《毛毛蟲波羅》，2017年則開始進行《你想活出怎樣的人生》的製作，但鈴木敏夫認為，這部動畫長片「不可能會是宮崎駿的最後一部作品」。</p>', 'test.jpg', ''),
(6, '凱特溫斯蕾主演新片因同志設定惹議', 'Rose', '', '2019-03-20', '<p>據外電報導，凱特溫斯蕾（Kate Winslet）現正拍攝中的新片《Ammonite》因為劇情設定引起了一些爭議，《Ammonite》時空背景是19世紀的英國，取材真實歷史人物瑪莉安寧（Mary Anning）的故事，瑪莉安寧的知名事蹟是在英倫海峽（English Channel）的峭壁發現侏羅紀時期遺留下來的海洋化石層（Jurassic marine fossil beds），電影主軸之一是終身未婚的瑪莉安寧與另一名女性之間的情感關係。</p>\r\n<p> </p>\r\n<p>凱特溫斯蕾在《Ammonite》飾演瑪莉安寧，飾演同性友人的則是希爾夏蘿南（Saoirse Ronan），但電影設定的這段同志戀情卻遭到瑪莉安寧的家族後人提出質疑。其中一位瑪莉安寧的家族後人主張沒有證據指出瑪莉安寧是同志，瑪莉安寧本人的經歷原本就極具故事性，為增添電影賣點而把未經確認發生過的同志戀情放入片中無法對故事產生加分效果，瑪莉安寧本人如果看到恐怕也會感到遺憾及不安。</p>\r\n<p> </p>\r\n<p>雖然不只一位家族後人不滿電影因商業或其他考量加入同志戀情的設定，但也有家族後人認為這個設定可能讓瑪莉安寧更具吸引力，只要電影呈現得宜不失品味且傳達出其精神，那仍是好的。《Ammonite》的製片公司對此異議亦作出回應，表示電影是取材瑪莉安寧的人生故事，無意拍成（全然依照史實的）傳記電影。《Ammonite》的導演及編劇是法蘭西斯李（Francis Lee），前一部作品是《春光之境》（God\'s Own Country）。</p>', 'test6.jpg', ''),
(7, '湯姆霍蘭有望再演《復仇者聯盟》導演新作', '彼格迪克', '', '2019-03-20', '<p>英國演員湯姆霍蘭（Tom Holland）15歲演出第一部電影《浩劫奇蹟》（The Impossible）後，陸續又演出了《我的生存之道》（How I Live Now）、《白鯨傳奇：怒海之心》（In the Heart of the Sea）及《失落之城》（The Lost City of Z）等片，但湯姆霍蘭最為一般大眾熟知的角色應仍屬漫威電影宇宙（Marvel Cinematic Universe）中的蜘蛛人（Spider-Man）一角。</p>\r\n<p>湯姆霍蘭在《美國隊長：英雄內戰》（Captain America: Civil War）、《復仇者聯盟：無限之戰》 （Avengers: Infinity War）及《復仇者聯盟：終局之戰》（Avengers: Endgame）及預計今年四月上映的《復仇者聯盟：終局之戰》（Avengers: Endgame）都飾演蜘蛛人，這三部片也都由安東尼羅索 （Anthony Russo）及喬羅素（Joe Russo）兩兄弟共同執導。據外電報導，湯姆霍蘭有望再演出羅素兄弟執導的新片《Cherry》。</p>\r\n<p>《Cherry》電影取材自尼寇沃克（Nico Walker）所著的書籍，故事主角是曾派駐伊拉克的軍醫（Army medic），退役後出現創傷後壓力症候群（Post-traumatic stress disorder），導致其沉迷鴉片甚至開始搶劫銀行。尼寇沃克本人與書中主角經歷雖非完全相同但亦有近似之處，現正服刑的尼寇沃克將於2020年獲釋。《Cherry》電影預計今年夏季開拍，上映日期未定。</p>', 'test7.jpg', ''),
(8, '《羅根》導演表示戲院上映版就是導演版', 'Hugh Jackman', '', '2019-03-20', '<p>《羅根》(Logan)是休傑克曼(Hugh Jackman)最後一次擔綱演出的金鋼狼系列電影，目前無論是普遍評價或票房表現都相當突出，因為片中有較血腥的畫面及較沉重的主題，《羅根》在美國是以R級上映(未滿十八歲須由家長或監護人陪同觀看)。詹姆士曼高德昨日在推特(Twitter)上被問到《羅根》之後是否會有導演版的出現，他回答表示目前戲院上映的版本(片長138分鐘)就是他的導演版。</p>\r\n<p>為了確保電影級別不會為了吸納更多可買票入場的觀眾而降級，休傑克曼當初選擇減薪演出《羅根》，以降低可買票入場的總體觀眾人數較少的潛在風險。據報導指出，投資《羅根》的片廠福斯影業並未對電影最終應如何呈現作出干預，而是交由導演詹姆士曼高德(James Mangold)創作發揮。</p>\r\n<p>詹姆士曼高德同時也是系列電影前作《金鋼狼：武士之戰》(The Wolverine》的導演，當時《金鋼狼：武士之戰》的美國上映版本是PG-13級(電影中包含不適合13歲以下兒童觀賞的內容)，後續推出的藍光加長版本放入了較多血腥場面，因而在審查後變成以R級發行。</p>\r\n<p>晚近發行過加長版本的超級英雄商業大片還有《蝙蝠俠對超人：正義曙光》(Batman v Superman: Dawn of Justice)及《自殺突擊隊》(Suicide Squad)，《蝙蝠俠對超人：正義曙光》的加長版本比戲院版多了約30分鐘，其中較多是關於超人克拉克肯特(Clark Kent)的部份，《自殺突擊隊》的加長版本則比戲院版多了約11分鐘，增加了一些由傑瑞拉托(Jared Leto)飾演的小丑的片段。</p>', 'test8.jpg', ''),
(9, '麥可法斯賓達談作品票房不佳的想法', '萬磁王', '', '2019-03-21', '<p>新作《刺客教條》(Assassin\'s Creed)正在戲院上映的人氣男星麥可法斯賓達(Michael Fassbender)近日在南非接受了《紐約時報》(New York Times)的電話訪問，其中包含了關於《刺客教條》及《為妳說的謊》(The Light Between Oceans)票房未盡理想的問題，以下是節錄的問答內容。</p>\r\n<p>問：你是否有計劃地輪替接拍獨立製片電影和大成本的片商電影？還是就順其自然？</p>\r\n<p>答：兩者都有一些，兩種電影我都喜歡參與。參與低成本的獨立製片電影感覺比較直接和親近，拍攝速度快，而且很刺激，有很多年輕優秀的電影人員都是從獨立製片電影冒出頭，無論是導演、編劇或演員。作為消費者，除了更貼近個人的獨立製片電影，我也一樣喜歡動作冒險電影。當有這麼多人能夠努力合作拍出一部規模龐大的電影，這是相當可觀的，就像是個大馬戲團一樣，雖然過程困難但很值得。</p>\r\n<p>問：你之前已有和《刺客教條》的導演賈斯汀科索(Justin Kurzel)和瑪莉詠柯蒂亞(Marion Cotillard)在2015年的《馬克白》(Macbeth)合作過，一個是電玩遊戲的角色，另一個則是莎士比亞小說的角色，在準備角色上兩者是否有所不同？</p>\r\n<p>答：基本上來說，兩者的構成元素是相同的。《刺客教條》有些不同是因為我也身兼該片製片，對我來說是個新的學習經驗。</p>\r\n<p>問：《刺客教條》在國際市場的票房還不錯，但美國市場的票房則不如預期，這對你有何影響？你認為自己的演出是否對票房有所助益？</p>\r\n<p>答：首先，以投資者的觀點來看，老實說你不想讓任何人虧錢，你一定希望讓投資者能回本獲利，因為如果做不到，你的名聲也會留下負面的記錄。我想某種層面上來說，就是試著盡可能地去學習。當影片上映後，你能做的其實不多，而是取決於觀眾。</p>\r\n<p>問：去年的《為妳說的謊》票房也不太理想，你認為原因為何？</p>\r\n<p>答：行銷人員應該會比我更能精確地回答這個問題(笑)，或許人們比較偏好待在家看這種類型的電影吧，我不知道(原因)，但我仍為這部電影感到驕傲。我不會坐在那邊想太多這類的事情，我就是參與自己有興趣的案子，為電影盡力演出，然後希望我的工作做得還不錯。</p>\r\n<p>問：你和雷利史考特(Ridley Scott)合作過三次，和賈斯汀科索合作過兩次，和史蒂夫麥昆(Steve McQueen)也合作過三次，和他們合作的過程中你的收穫是什麼？</p>\r\n<p>答：當大家想法相近又好溝通是件很棒的事，會讓事情變得容易很多。在工作中能獲得歡樂對我至關重要，因為我工作時間很長，所以我喜歡享受工作時的經驗。當你遇到志同道合的人，你就可以(從工作中)獲得歡樂，然後就會想再繼續合作。</p>', 'test9.jpg', ''),
(10, '川普計劃使用和《國定殺戮日》相同的宣傳口號競選連任', '川普', '', '2019-03-21', '<p>雖然唐納川普(Donald Trump)還未正式就任美國總統，但他已經想好四年後競選連任的宣傳口號了。近日他在與《華盛頓郵報》(The Washington Post)的訪問中，透露了他個人未來希望採用的競選口號是「讓美國持續強大」(Keep America Great)。</p>\r\n<p>講完後，唐納川普把自己的律師叫進來問說：「你可以去登記註冊一下(這個口號)嗎... 我想我喜歡這個口號，對吧？」並交代律師「讓美國持續強大」這句口號結尾有無驚嘆號的版本都要登記註冊。</p>\r\n<p>這個「讓美國持續強大」的口號，其實先前已經有被使用過在電影上，而這部電影是於2016年上映的《國定殺戮日：大選之年》(The Purge: Election Year)。《國定殺戮日：大選之年》是《國定殺戮日》系列電影的第三集。該系列電影的設定是某個時空下的美國為了降低犯罪率，每年會開放12個小時讓犯罪合法化，在該段期間內所進行的非法行為事後皆不會遭到追訴。</p>\r\n<p>評論者吉田艾蜜莉(Emily Yoshida)指出在《國定殺戮日》系列電影中，不僅是要清洗美國人的罪惡，也是要清洗美國貧窮的弱勢階層，而這些弱勢階層往往是非白人的有色人種。也有人可能會提到「讓美國持續強大」及唐納川普此次使用的競選口號「讓美國再次強大」(Make America Great Again)背後有著類似的意念，尤其是以政府收入的角度考量國民建康、教育、移民、勞工薪資等政策時。</p>\r\n<p>當時《國定殺戮日：大選之年》是將「讓美國持續強大」這句口號使用在宣傳影片上，而非出現在電影正片中，至於唐納川普是否看過《國定殺戮日》系列電影，或是得知此相同的口號有被運用在電影宣傳上，則暫時尚未得知。</p>', 'test10.jpg', ''),
(11, '玩具總動員4預告片曝！ 牧羊女大變身', '胡迪', '', '2019-03-16', '<p>皮克斯招牌動畫「玩具總動員」系列卡通，今年暑假，即將再推出第4集，現在正式預告片也出爐了，消失一集的牧羊女，重新回歸，但形象跟以往很不一樣，呈現獨立、幹練形象，除了卡通片，彭于晏主演的新片，這回挑戰新的角色，擔任救援隊成員，除了要跳機還面臨許多爆破場景，據了解劇組還特別請來好萊塢團隊，花費約32.2億台幣打造而成。</p>', 'test2.jpg', ''),
(12, '《冰與火之歌：權力遊戲》渡鴉、龍飛太快？第八季更注重時間邏輯！', '艾蜜莉亞·克拉克', '', '2019-03-21', '<p>2017年《冰與火之歌：權力遊戲》（Game of Thrones）播出第七季，首次減少為7集，而不是往年的10集，所以故事進度神速，「瑟曦蘭尼斯特」與「攸倫葛雷喬伊」組同盟，「珊莎史塔克」、「布蘭史塔克」與妹妹「艾莉亞史塔克」重聚後對付小指頭、「瓊恩雪諾」與「丹妮莉絲坦格利安」不只聯手還戀愛了，夜王得到異鬼龍，把絕境長城炸破一個洞，劇情節奏跟前幾季比，可說是緊湊到不可思議，許多角色在廣闊的維斯特洛大地快速穿梭，讓許多觀眾討論和吐槽，「詹德利」跑多快？渡鴉飛多快？龍飛多快？才能讓「丹妮莉絲」及時趕到長城外，去救被異鬼大軍包圍的「瓊恩雪諾」一行人？</p>\r\n<p>對於這些質疑，執行製作人 布萊恩考克曼（Bryan Cogman）接受《娛樂週刊》訪問時表示：「上一季我們做了決定，就是別管那麼多，觀眾可以坐在家裡算數學，算搭船從A到B會花多久時間？（指臨冬城到龍石島的距離時間）不管你們算多久，沒錯，就是多久，我想觀眾感到憤慨總比其他情緒好，所以我接受。」</p>\r\n<p>影集統籌DB Weiss補充說：「我們不會閱讀太多網上的批評，如果有人說：『我不喜歡你們的做法』我不知道這樣的觀眾佔多少百分比，即使這個意見在社群上討論熱烈，很可能是1%觀眾在社群上討論，10分鐘後，就變得不只1%了，我沒有興趣知道到底有多少觀眾實際上這麼想，因為當你開始思考，就會讓自己發瘋。」</p>\r\n<p>儘管製作人與影集統籌都表示不在意影迷的吐槽，不過編劇 戴夫希爾（Dave Hill）仍表示，尚未播出的第八季雖然只有六集，但應該不會讓觀眾產生相同的質疑，他說：「第八季有許多事情發生，為了故事的平衡，必須加快劇情速度，有很多時間刪減，其實是可以上字幕『三週過去了』，但我們沒有這樣做。第八季我們試圖保留更多時間邏輯，而不是給角色背上噴射背包。」</p>\r\n<p>《冰與火之歌：權力遊戲》第八季最後六集將於4月15日回歸HBO。</p>', 'test3.png', 'https://zh.wikipedia.org/wiki/%E6%9D%83%E5%8A%9B%E7%9A%84%E6%B8%B8%E6%88%8F_(%E7%94%B5%E8%A7%86%E5%89%A7)'),
(13, '迪士尼、福斯正式合併　《X戰警》確定回歸《復仇者》', '死特', '', '2019-03-20', '<p>歷史性的一刻！迪士尼、福斯於紐約時間20日凌晨12點02分（台灣時間20日中午12點02分）正式合併，好萊塢6大巨頭重新洗牌，未來福斯將成為迪士尼的子公司之一，而迪士尼握有福斯版權包括《X戰警》、《異形》、《阿凡達》、《辛普森家庭》等，全球票房佔有率將從30％提升至40％，一年賺進超過75億美金，「死侍」萊恩雷諾斯戴上「米老鼠帽」曬照紀念「換東家」的這一天。</p>\r\n<p>迪士尼以71億美金（約2188億台幣）收購福斯，於20日凌晨12點02分合併生效。迪士尼CEO羅伯特艾格（Robert Bob Iger）紐約時間19日下午發表聲明：「這對我們來說是一個非凡的歷史性時刻，將為我們公司和股東創造巨大的長期價值，結合迪士尼、福斯多元且創意內容、經驗豐富的人才，創造卓越的全球娛樂公司，有利於領導一個充滿活力和改變的時代。」同時，迪士尼強調，合併主要是幫助公司「增加其國際足跡」、「擴大直接面對消費者的產品」。</p>\r\n<p>迪士尼旗下包括迪士尼電影公司、迪士尼動畫工作室等，2006年起併購皮克斯工作室，2009年買下漫威娛樂，並在隔年成立漫威工作室，2012年買下《星際大戰》版權擁有者盧卡斯影業，如今福斯影片也成為迪士尼的子公司之一，未來迪士尼將握有福斯版權包括《死侍》、《X戰警》、《驚奇四超人》、《異形》、《阿凡達》、《猩球崛起》、《金牌特務》、《艾莉塔》等以及電視作品《辛普森家庭》、《X檔案》等。</p>', 'test4.jpg', ''),
(14, '驚奇隊長踹飛《突擊隊》全球狂賣235億', '尼克．福瑞', '', '2019-03-20', '<p>漫威超級英雄電影《驚奇隊長》（Captain Marvel）票房一飛衝天，不僅全台狂賣3億467萬元，蟬聯票房冠軍，全球累積至前天高達7.6億美元（約235.6億元台幣），超越《美國隊長2：酷寒戰士》、《奇異博士》、《自殺突擊隊》等超英片，外媒預測將《驚奇隊長》全球賣座上看10億美元（約310億元台幣）。</p>\r\n<p>金獎影后布麗拉森飾演的驚奇隊長也將在《復仇者聯盟4：終局之戰》對抗薩諾斯，上周五釋出的最新預告中也令「雷神索爾」認可「我喜歡這一位」，令影迷熱血沸騰。</p>\r\n<p>《復仇者4》下月登場</p>\r\n<p>《復仇者4》預告在24小時內創下2.68億次點閱，是繼去年12月首支預告的2.89億次，該片連霸史上首日點閱次數最高與次高紀錄，可見粉絲期待度破表。《復仇者4》下月24日在台上映。</p>', 'test5.jpg', ''),
(15, '宮崎駿多次「引退詐欺」 吉卜力資深製作人看不下去：請別再說自己要引退', '娜烏希卡', '', '2019-03-20', '<p>日本動畫大師宮崎駿在1986年完成長篇動畫《天空之城》後，至今宣佈過多達7次的引退宣言，不過從他目前在正製作第12部長篇動畫《你想活出怎樣的人生》的情況看來，先前的引退宣言已經是全數跳票。吉卜力工作室資深製片人鈴木敏夫於日前接受動畫新聞網（ANN）採訪時表示「完全不相信宮崎駿的引退宣言」，他認為宮崎駿是一個不可能退休的人，未來也肯定會「不斷的畫下去」。</p>\r\n<p>從1986到2013共提出了7次的引退宣言，最後一次便是在《風起》推出後，而這也是最慎重的一次。不過，歷經短暫的休息，宮崎駿仍是閒不下來，隨即又在2015年以首次的CG電腦繪圖推出構思已久的動畫短片《毛毛蟲波羅》，2017年則開始進行《你想活出怎樣的人生》的製作，但鈴木敏夫認為，這部動畫長片「不可能會是宮崎駿的最後一部作品」。</p>', 'test.jpg', ''),
(16, '凱特溫斯蕾主演新片因同志設定惹議', 'Rose', '', '2019-03-20', '<p>據外電報導，凱特溫斯蕾（Kate Winslet）現正拍攝中的新片《Ammonite》因為劇情設定引起了一些爭議，《Ammonite》時空背景是19世紀的英國，取材真實歷史人物瑪莉安寧（Mary Anning）的故事，瑪莉安寧的知名事蹟是在英倫海峽（English Channel）的峭壁發現侏羅紀時期遺留下來的海洋化石層（Jurassic marine fossil beds），電影主軸之一是終身未婚的瑪莉安寧與另一名女性之間的情感關係。</p>\r\n<p> </p>\r\n<p>凱特溫斯蕾在《Ammonite》飾演瑪莉安寧，飾演同性友人的則是希爾夏蘿南（Saoirse Ronan），但電影設定的這段同志戀情卻遭到瑪莉安寧的家族後人提出質疑。其中一位瑪莉安寧的家族後人主張沒有證據指出瑪莉安寧是同志，瑪莉安寧本人的經歷原本就極具故事性，為增添電影賣點而把未經確認發生過的同志戀情放入片中無法對故事產生加分效果，瑪莉安寧本人如果看到恐怕也會感到遺憾及不安。</p>\r\n<p> </p>\r\n<p>雖然不只一位家族後人不滿電影因商業或其他考量加入同志戀情的設定，但也有家族後人認為這個設定可能讓瑪莉安寧更具吸引力，只要電影呈現得宜不失品味且傳達出其精神，那仍是好的。《Ammonite》的製片公司對此異議亦作出回應，表示電影是取材瑪莉安寧的人生故事，無意拍成（全然依照史實的）傳記電影。《Ammonite》的導演及編劇是法蘭西斯李（Francis Lee），前一部作品是《春光之境》（God\'s Own Country）。</p>', 'test6.jpg', ''),
(17, '湯姆霍蘭有望再演《復仇者聯盟》導演新作', '彼格迪克', '', '2019-03-20', '<p>英國演員湯姆霍蘭（Tom Holland）15歲演出第一部電影《浩劫奇蹟》（The Impossible）後，陸續又演出了《我的生存之道》（How I Live Now）、《白鯨傳奇：怒海之心》（In the Heart of the Sea）及《失落之城》（The Lost City of Z）等片，但湯姆霍蘭最為一般大眾熟知的角色應仍屬漫威電影宇宙（Marvel Cinematic Universe）中的蜘蛛人（Spider-Man）一角。</p>\r\n<p>湯姆霍蘭在《美國隊長：英雄內戰》（Captain America: Civil War）、《復仇者聯盟：無限之戰》 （Avengers: Infinity War）及《復仇者聯盟：終局之戰》（Avengers: Endgame）及預計今年四月上映的《復仇者聯盟：終局之戰》（Avengers: Endgame）都飾演蜘蛛人，這三部片也都由安東尼羅索 （Anthony Russo）及喬羅素（Joe Russo）兩兄弟共同執導。據外電報導，湯姆霍蘭有望再演出羅素兄弟執導的新片《Cherry》。</p>\r\n<p>《Cherry》電影取材自尼寇沃克（Nico Walker）所著的書籍，故事主角是曾派駐伊拉克的軍醫（Army medic），退役後出現創傷後壓力症候群（Post-traumatic stress disorder），導致其沉迷鴉片甚至開始搶劫銀行。尼寇沃克本人與書中主角經歷雖非完全相同但亦有近似之處，現正服刑的尼寇沃克將於2020年獲釋。《Cherry》電影預計今年夏季開拍，上映日期未定。</p>', 'test7.jpg', ''),
(18, '《羅根》導演表示戲院上映版就是導演版', 'Hugh Jackman', '', '2019-03-20', '<p>《羅根》(Logan)是休傑克曼(Hugh Jackman)最後一次擔綱演出的金鋼狼系列電影，目前無論是普遍評價或票房表現都相當突出，因為片中有較血腥的畫面及較沉重的主題，《羅根》在美國是以R級上映(未滿十八歲須由家長或監護人陪同觀看)。詹姆士曼高德昨日在推特(Twitter)上被問到《羅根》之後是否會有導演版的出現，他回答表示目前戲院上映的版本(片長138分鐘)就是他的導演版。</p>\r\n<p>為了確保電影級別不會為了吸納更多可買票入場的觀眾而降級，休傑克曼當初選擇減薪演出《羅根》，以降低可買票入場的總體觀眾人數較少的潛在風險。據報導指出，投資《羅根》的片廠福斯影業並未對電影最終應如何呈現作出干預，而是交由導演詹姆士曼高德(James Mangold)創作發揮。</p>\r\n<p>詹姆士曼高德同時也是系列電影前作《金鋼狼：武士之戰》(The Wolverine》的導演，當時《金鋼狼：武士之戰》的美國上映版本是PG-13級(電影中包含不適合13歲以下兒童觀賞的內容)，後續推出的藍光加長版本放入了較多血腥場面，因而在審查後變成以R級發行。</p>\r\n<p>晚近發行過加長版本的超級英雄商業大片還有《蝙蝠俠對超人：正義曙光》(Batman v Superman: Dawn of Justice)及《自殺突擊隊》(Suicide Squad)，《蝙蝠俠對超人：正義曙光》的加長版本比戲院版多了約30分鐘，其中較多是關於超人克拉克肯特(Clark Kent)的部份，《自殺突擊隊》的加長版本則比戲院版多了約11分鐘，增加了一些由傑瑞拉托(Jared Leto)飾演的小丑的片段。</p>', 'test8.jpg', ''),
(19, '麥可法斯賓達談作品票房不佳的想法', '萬磁王', '', '2019-03-21', '<p>新作《刺客教條》(Assassin\'s Creed)正在戲院上映的人氣男星麥可法斯賓達(Michael Fassbender)近日在南非接受了《紐約時報》(New York Times)的電話訪問，其中包含了關於《刺客教條》及《為妳說的謊》(The Light Between Oceans)票房未盡理想的問題，以下是節錄的問答內容。</p>\r\n<p>問：你是否有計劃地輪替接拍獨立製片電影和大成本的片商電影？還是就順其自然？</p>\r\n<p>答：兩者都有一些，兩種電影我都喜歡參與。參與低成本的獨立製片電影感覺比較直接和親近，拍攝速度快，而且很刺激，有很多年輕優秀的電影人員都是從獨立製片電影冒出頭，無論是導演、編劇或演員。作為消費者，除了更貼近個人的獨立製片電影，我也一樣喜歡動作冒險電影。當有這麼多人能夠努力合作拍出一部規模龐大的電影，這是相當可觀的，就像是個大馬戲團一樣，雖然過程困難但很值得。</p>\r\n<p>問：你之前已有和《刺客教條》的導演賈斯汀科索(Justin Kurzel)和瑪莉詠柯蒂亞(Marion Cotillard)在2015年的《馬克白》(Macbeth)合作過，一個是電玩遊戲的角色，另一個則是莎士比亞小說的角色，在準備角色上兩者是否有所不同？</p>\r\n<p>答：基本上來說，兩者的構成元素是相同的。《刺客教條》有些不同是因為我也身兼該片製片，對我來說是個新的學習經驗。</p>\r\n<p>問：《刺客教條》在國際市場的票房還不錯，但美國市場的票房則不如預期，這對你有何影響？你認為自己的演出是否對票房有所助益？</p>\r\n<p>答：首先，以投資者的觀點來看，老實說你不想讓任何人虧錢，你一定希望讓投資者能回本獲利，因為如果做不到，你的名聲也會留下負面的記錄。我想某種層面上來說，就是試著盡可能地去學習。當影片上映後，你能做的其實不多，而是取決於觀眾。</p>\r\n<p>問：去年的《為妳說的謊》票房也不太理想，你認為原因為何？</p>\r\n<p>答：行銷人員應該會比我更能精確地回答這個問題(笑)，或許人們比較偏好待在家看這種類型的電影吧，我不知道(原因)，但我仍為這部電影感到驕傲。我不會坐在那邊想太多這類的事情，我就是參與自己有興趣的案子，為電影盡力演出，然後希望我的工作做得還不錯。</p>\r\n<p>問：你和雷利史考特(Ridley Scott)合作過三次，和賈斯汀科索合作過兩次，和史蒂夫麥昆(Steve McQueen)也合作過三次，和他們合作的過程中你的收穫是什麼？</p>\r\n<p>答：當大家想法相近又好溝通是件很棒的事，會讓事情變得容易很多。在工作中能獲得歡樂對我至關重要，因為我工作時間很長，所以我喜歡享受工作時的經驗。當你遇到志同道合的人，你就可以(從工作中)獲得歡樂，然後就會想再繼續合作。</p>', 'test9.jpg', ''),
(20, '川普計劃使用和《國定殺戮日》相同的宣傳口號競選連任', '川普', '', '2019-03-21', '<p>雖然唐納川普(Donald Trump)還未正式就任美國總統，但他已經想好四年後競選連任的宣傳口號了。近日他在與《華盛頓郵報》(The Washington Post)的訪問中，透露了他個人未來希望採用的競選口號是「讓美國持續強大」(Keep America Great)。</p>\r\n<p>講完後，唐納川普把自己的律師叫進來問說：「你可以去登記註冊一下(這個口號)嗎... 我想我喜歡這個口號，對吧？」並交代律師「讓美國持續強大」這句口號結尾有無驚嘆號的版本都要登記註冊。</p>\r\n<p>這個「讓美國持續強大」的口號，其實先前已經有被使用過在電影上，而這部電影是於2016年上映的《國定殺戮日：大選之年》(The Purge: Election Year)。《國定殺戮日：大選之年》是《國定殺戮日》系列電影的第三集。該系列電影的設定是某個時空下的美國為了降低犯罪率，每年會開放12個小時讓犯罪合法化，在該段期間內所進行的非法行為事後皆不會遭到追訴。</p>\r\n<p>評論者吉田艾蜜莉(Emily Yoshida)指出在《國定殺戮日》系列電影中，不僅是要清洗美國人的罪惡，也是要清洗美國貧窮的弱勢階層，而這些弱勢階層往往是非白人的有色人種。也有人可能會提到「讓美國持續強大」及唐納川普此次使用的競選口號「讓美國再次強大」(Make America Great Again)背後有著類似的意念，尤其是以政府收入的角度考量國民建康、教育、移民、勞工薪資等政策時。</p>\r\n<p>當時《國定殺戮日：大選之年》是將「讓美國持續強大」這句口號使用在宣傳影片上，而非出現在電影正片中，至於唐納川普是否看過《國定殺戮日》系列電影，或是得知此相同的口號有被運用在電影宣傳上，則暫時尚未得知。</p>', 'test10.jpg', ''),
(21, '玩具總動員4預告片曝！ 牧羊女大變身', '胡迪', '', '2019-03-16', '<p>皮克斯招牌動畫「玩具總動員」系列卡通，今年暑假，即將再推出第4集，現在正式預告片也出爐了，消失一集的牧羊女，重新回歸，但形象跟以往很不一樣，呈現獨立、幹練形象，除了卡通片，彭于晏主演的新片，這回挑戰新的角色，擔任救援隊成員，除了要跳機還面臨許多爆破場景，據了解劇組還特別請來好萊塢團隊，花費約32.2億台幣打造而成。</p>', 'test2.jpg', ''),
(22, '《冰與火之歌：權力遊戲》渡鴉、龍飛太快？第八季更注重時間邏輯！', '艾蜜莉亞·克拉克', '', '2019-03-21', '<p>2017年《冰與火之歌：權力遊戲》（Game of Thrones）播出第七季，首次減少為7集，而不是往年的10集，所以故事進度神速，「瑟曦蘭尼斯特」與「攸倫葛雷喬伊」組同盟，「珊莎史塔克」、「布蘭史塔克」與妹妹「艾莉亞史塔克」重聚後對付小指頭、「瓊恩雪諾」與「丹妮莉絲坦格利安」不只聯手還戀愛了，夜王得到異鬼龍，把絕境長城炸破一個洞，劇情節奏跟前幾季比，可說是緊湊到不可思議，許多角色在廣闊的維斯特洛大地快速穿梭，讓許多觀眾討論和吐槽，「詹德利」跑多快？渡鴉飛多快？龍飛多快？才能讓「丹妮莉絲」及時趕到長城外，去救被異鬼大軍包圍的「瓊恩雪諾」一行人？</p>\r\n<p>對於這些質疑，執行製作人 布萊恩考克曼（Bryan Cogman）接受《娛樂週刊》訪問時表示：「上一季我們做了決定，就是別管那麼多，觀眾可以坐在家裡算數學，算搭船從A到B會花多久時間？（指臨冬城到龍石島的距離時間）不管你們算多久，沒錯，就是多久，我想觀眾感到憤慨總比其他情緒好，所以我接受。」</p>\r\n<p>影集統籌DB Weiss補充說：「我們不會閱讀太多網上的批評，如果有人說：『我不喜歡你們的做法』我不知道這樣的觀眾佔多少百分比，即使這個意見在社群上討論熱烈，很可能是1%觀眾在社群上討論，10分鐘後，就變得不只1%了，我沒有興趣知道到底有多少觀眾實際上這麼想，因為當你開始思考，就會讓自己發瘋。」</p>\r\n<p>儘管製作人與影集統籌都表示不在意影迷的吐槽，不過編劇 戴夫希爾（Dave Hill）仍表示，尚未播出的第八季雖然只有六集，但應該不會讓觀眾產生相同的質疑，他說：「第八季有許多事情發生，為了故事的平衡，必須加快劇情速度，有很多時間刪減，其實是可以上字幕『三週過去了』，但我們沒有這樣做。第八季我們試圖保留更多時間邏輯，而不是給角色背上噴射背包。」</p>\r\n<p>《冰與火之歌：權力遊戲》第八季最後六集將於4月15日回歸HBO。</p>', 'test3.png', 'https://zh.wikipedia.org/wiki/%E6%9D%83%E5%8A%9B%E7%9A%84%E6%B8%B8%E6%88%8F_(%E7%94%B5%E8%A7%86%E5%89%A7)'),
(23, '迪士尼、福斯正式合併　《X戰警》確定回歸《復仇者》', '死特', '', '2019-03-20', '<p>歷史性的一刻！迪士尼、福斯於紐約時間20日凌晨12點02分（台灣時間20日中午12點02分）正式合併，好萊塢6大巨頭重新洗牌，未來福斯將成為迪士尼的子公司之一，而迪士尼握有福斯版權包括《X戰警》、《異形》、《阿凡達》、《辛普森家庭》等，全球票房佔有率將從30％提升至40％，一年賺進超過75億美金，「死侍」萊恩雷諾斯戴上「米老鼠帽」曬照紀念「換東家」的這一天。</p>\r\n<p>迪士尼以71億美金（約2188億台幣）收購福斯，於20日凌晨12點02分合併生效。迪士尼CEO羅伯特艾格（Robert Bob Iger）紐約時間19日下午發表聲明：「這對我們來說是一個非凡的歷史性時刻，將為我們公司和股東創造巨大的長期價值，結合迪士尼、福斯多元且創意內容、經驗豐富的人才，創造卓越的全球娛樂公司，有利於領導一個充滿活力和改變的時代。」同時，迪士尼強調，合併主要是幫助公司「增加其國際足跡」、「擴大直接面對消費者的產品」。</p>\r\n<p>迪士尼旗下包括迪士尼電影公司、迪士尼動畫工作室等，2006年起併購皮克斯工作室，2009年買下漫威娛樂，並在隔年成立漫威工作室，2012年買下《星際大戰》版權擁有者盧卡斯影業，如今福斯影片也成為迪士尼的子公司之一，未來迪士尼將握有福斯版權包括《死侍》、《X戰警》、《驚奇四超人》、《異形》、《阿凡達》、《猩球崛起》、《金牌特務》、《艾莉塔》等以及電視作品《辛普森家庭》、《X檔案》等。</p>', 'test4.jpg', ''),
(24, '驚奇隊長踹飛《突擊隊》全球狂賣235億', '尼克．福瑞', '', '2019-03-20', '<p>漫威超級英雄電影《驚奇隊長》（Captain Marvel）票房一飛衝天，不僅全台狂賣3億467萬元，蟬聯票房冠軍，全球累積至前天高達7.6億美元（約235.6億元台幣），超越《美國隊長2：酷寒戰士》、《奇異博士》、《自殺突擊隊》等超英片，外媒預測將《驚奇隊長》全球賣座上看10億美元（約310億元台幣）。</p>\r\n<p>金獎影后布麗拉森飾演的驚奇隊長也將在《復仇者聯盟4：終局之戰》對抗薩諾斯，上周五釋出的最新預告中也令「雷神索爾」認可「我喜歡這一位」，令影迷熱血沸騰。</p>\r\n<p>《復仇者4》下月登場</p>\r\n<p>《復仇者4》預告在24小時內創下2.68億次點閱，是繼去年12月首支預告的2.89億次，該片連霸史上首日點閱次數最高與次高紀錄，可見粉絲期待度破表。《復仇者4》下月24日在台上映。</p>', 'test5.jpg', ''),
(25, '宮崎駿多次「引退詐欺」 吉卜力資深製作人看不下去：請別再說自己要引退', '娜烏希卡', '', '2019-03-20', '<p>日本動畫大師宮崎駿在1986年完成長篇動畫《天空之城》後，至今宣佈過多達7次的引退宣言，不過從他目前在正製作第12部長篇動畫《你想活出怎樣的人生》的情況看來，先前的引退宣言已經是全數跳票。吉卜力工作室資深製片人鈴木敏夫於日前接受動畫新聞網（ANN）採訪時表示「完全不相信宮崎駿的引退宣言」，他認為宮崎駿是一個不可能退休的人，未來也肯定會「不斷的畫下去」。</p>\r\n<p>從1986到2013共提出了7次的引退宣言，最後一次便是在《風起》推出後，而這也是最慎重的一次。不過，歷經短暫的休息，宮崎駿仍是閒不下來，隨即又在2015年以首次的CG電腦繪圖推出構思已久的動畫短片《毛毛蟲波羅》，2017年則開始進行《你想活出怎樣的人生》的製作，但鈴木敏夫認為，這部動畫長片「不可能會是宮崎駿的最後一部作品」。</p>', 'test.jpg', '');

--
-- 已匯出資料表的索引
--

--
-- 資料表索引 `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`sid`);

--
-- 在匯出的資料表使用 AUTO_INCREMENT
--

--
-- 使用資料表 AUTO_INCREMENT `article`
--
ALTER TABLE `article`
  MODIFY `sid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
