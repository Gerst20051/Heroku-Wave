<?php
$url = parse_url(getenv("CLEARDB_DATABASE_URL"));
$server = $url["host"];
$username = $url["user"];
$password = $url["pass"];
$db = substr($url["path"],1);

print_r($url);

$link = mysql_connect($server, $username, $password);

if (!$link) {
	echo "<p>Could not connect to the server '" . $server . "'</p>\n";
	echo mysql_error();
} else {
	echo "<p>Successfully connected to the server '" . $server . "'</p>\n";
	printf("<p>MySQL client info: %s</p>\n", mysql_get_client_info());
	printf("<p>MySQL host info: %s</p>\n", mysql_get_host_info());
	printf("<p>MySQL server version: %s</p>\n", mysql_get_server_info());
	printf("<p>MySQL protocol version: %s</p>\n", mysql_get_proto_info());
}

if ($link && !$db) {
	echo "<p>No database name was given. Available databases:</p>\n";
	$db_list = mysql_list_dbs($link);
	echo "<pre>\n";
	while ($row = mysql_fetch_array($db_list)) {
	     echo $row['Database'] . "\n";
	}
	echo "</pre>\n";
}

if ($db) {
	$dbcheck = mysql_select_db($db);
	if (!$dbcheck) {
		echo mysql_error();
	} else {
		echo "<p>Successfully connected to the database '" . $db . "'</p>\n";
		$sql = "SHOW TABLES FROM `$db`";
		$result = mysql_query($sql);
		if (0 < mysql_num_rows($result)) {
			echo "<p>Available tables:</p>\n";
			echo "<pre>\n";
			while ($row = mysql_fetch_row($result)) {
				echo "{$row[0]}\n";
			}
			echo "</pre>\n";
		} else {
			echo "<p>The database '" . $db . "' contains no tables.</p>\n";
			echo mysql_error();
		}
	}
}

$CREATETABLES = false;

if ($CREATETABLES) {
	$query = 'CREATE TABLE `users` (
	  `uid` int(11) unsigned NOT NULL AUTO_INCREMENT,
	  `email` varchar(50) NOT NULL,
	  `pass` varchar(256) NOT NULL,
	  `salt` varchar(64) NOT NULL,
	  `username` varchar(50) NOT NULL,
	  `firstname` varchar(50) NOT NULL,
	  `lastname` varchar(50) NOT NULL,
	  `access_level` tinyint(1) NOT NULL,
	  `last_login` int(11) NOT NULL,
	  `date_joined` int(11) NOT NULL,
	  `logins` int(11) NOT NULL,
	  PRIMARY KEY (`uid`),
	  UNIQUE KEY `username` (`username`)
	) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;';

	$result = mysql_query($query);
	if (!$result) {
		echo mysql_error() . "\n";
	}

	$query = 'CREATE TABLE `quotes` (
	  `id` int(10) NOT NULL AUTO_INCREMENT,
	  `owner_id` int(10) NOT NULL,
	  `quote` text NOT NULL,
	  `timestamp` int(15) NOT NULL,
	  PRIMARY KEY (`id`),
	  KEY `owner_id` (`owner_id`)
	) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;';

	$result = mysql_query($query);
	if (!$result) {
		echo mysql_error() . "\n";
	}
}

$ALTERTABLES = true;

if ($ALTERTABLES) {
	/*
	$query = "ALTER TABLE users";

	$result = mysql_query($query);
	if (!$result) {
		echo mysql_error() . "\n";
	}

	mysql_query("INSERT INTO table (name, age) VALUES ('First Last', 19)") or die(mysql_error());
	*/

mysql_query('INSERT INTO `quotes` VALUES(1, 1, \'{"name":"Shakespeare","quote":"If music be the food of love, play on."}\', 1351413690)');
mysql_query('INSERT INTO `quotes` VALUES(3, 1, \'{"name":"Eve Marie Carson","quote":"Study hard and work hard, play hard, keep an open mind, take pride in yourself, in your school, in what you produce, and the way you help others, if you make mistakes make sure you learn from them and never give up, stay strong to the finish."}\', 1351414059)');
mysql_query('INSERT INTO `quotes` VALUES(11, 1, \'{"name":"Petr Mitrichev","quote":"Once you find programming is no fun anymore \\u2013 drop it. Play soccer, find a girlfriend, study something not related to programming, just live a life \\u2013 programming contests are only programming contests, and nothing more. Don\\u2019t let them become your life \\u2013 for your life is much more interesting and colorful."}\', 1364192466)');
mysql_query('INSERT INTO `quotes` VALUES(12, 1, \'{"name":"Walker Percy","quote":"Why is Self the only Object in the cosmos which gets bored? Social life is disappointing. The very franticness of attempts to reestablish community and festival, by partying, by groups, by club, by touristy Mardi Gras, is the best evidence of the loss of true community and festival and of the loneliness of self, stranded as it is as an unspeakable consciousness in a world from which it perceives itself as somehow estranged, stranded even within its own body, with which it sees no clear connection. The very word boredom does not exist in any premodern language, it did not enter the language until the eighteenth century. No one knows its etymology."}\', 1364192568)');
mysql_query('INSERT INTO `quotes` VALUES(13, 1, \'{"name":"Walker Percy","quote":"The typical 4-year-old tends to be rather a joy. His enthusiasm, his exuberance, his willingness to go more than halfway to meet others in a spirit of fun are all refreshing... He is basically highly positive, enthusiastic, appreciative. This makes him fun to be with, an engaging, amusing, ever-challenging friend. Fours enjoy each other, they appreciate the challenge that other children offer. This is an age at which children interest and admire each other most... The four year old is a concelebrant of the world and even of his own peers.\\n\\nThe seven-year-old? Something has happened in the interval. More aware of and withdrawn into self... Seems to be in \"another world\"... Self-conscious about own body. Sensitive about exposing body. Does not like to be touched. Modest about toileting... Protects self by withdrawal. May be unwilling to expose knowledge, for fear of being laughed at or criticized... Apt to expect too much of self."}\', 1364192578)');
mysql_query('INSERT INTO `quotes` VALUES(14, 1, \'{"name":"Greg Melander","quote":"A simple mistake can tell me what you aren\'t. Or remind me why I love you."}\', 1364192680)');
mysql_query('INSERT INTO `quotes` VALUES(15, 1, \'{"name":"Dr. Seuss","quote":"Be Who You Are and Say What You Feel Because Those Who Mind Don\'t Matter and Those Who Matter Don\'t Mind."}\', 1364246957)');
mysql_query('INSERT INTO `quotes` VALUES(16, 1, \'{"name":"Winston Churchill","quote":"Never give up on something that you can\'t go a day without thinking about."}\', 1364248387)');
mysql_query('INSERT INTO `quotes` VALUES(17, 1, \'{"name":"Dr. Wayne Dyer","quote":"Lose the need to feel understood."}\', 1364278000)');
mysql_query('INSERT INTO `quotes` VALUES(18, 1, \'{"name":"Richard La Ruina (Gambler)","quote":"My confidence was already boosted from all the pickup artist theory now stored in my head. I felt I had a secret weapon I could deploy with devastating results. And why not? It had a 100 percent success rate so far. Other guys didn\\u2019t know this stuff. They were idiots!"}\', 1364278415)');
mysql_query('INSERT INTO `quotes` VALUES(19, 1, \'{"name":"Richard La Ruina (Gambler)","quote":"I wanted more. I wanted to be the coolest guy in the room, the guy that gets the girl and also has of bunch of cool friends and a social life. Bottom line: I wanted it all. I wanted to be the real deal."}\', 1364278509)');
mysql_query('INSERT INTO `quotes` VALUES(20, 1, \'{"name":"Richard La Ruina (Gambler)","quote":"I realized that women like men to lead; asking a woman if she wants to kiss, or waiting ages to do it, is just unattractive."}\', 1364278767)');
mysql_query('INSERT INTO `quotes` VALUES(21, 1, \'{"name":"Richard La Ruina (Gambler)","quote":"The next milestone happened one night when I was at a trendy dance club. The friend I was with identified a hot girl. She was tall, blond, and thin, with blue eyes--just my type. I went over and sat down next to her and started chatting away. After some teasing banter to challenge her, I lightly touched her leg and arm, and she reciprocated. I went for the kiss after about five minutes. Then I led her around the club: \\u201cLet\\u2019s go get a drink\\u201d became \\u201cLet\\u2019s dance,\\u201d which then became \\u201cLet\\u2019s sit down.\\u201d We got quite hot and heavy on the sidelines, and then I just got up, took her hand, and said, \\u201cLet\\u2019s go.\\u201d She walked with me, asking only, \\u201cWhere?\\u201d I said, \\u201cSomewhere else,\\u201d and led her out of the club and over to my place."}\', 1364278826)');
mysql_query('INSERT INTO `quotes` VALUES(22, 1, \'{"name":"Richard La Ruina (Gambler)","quote":"An attractive man is one who has a strong sense of self: a man who likes himself, trusts himself, and is confident in his own ability to act effectively in the world. At the room of his psychology is a strong set of beliefs--about himself, about how other people should treat him, and about what he is entitled to. These beliefs empower him to behave in an attractive manner and get what he wants in life. This includes women."}\', 1364278838)');
mysql_query('INSERT INTO `quotes` VALUES(23, 1, \'{"name":"Richard La Ruina (Gambler)","quote":"Women will pick up on your behavior, determine that you are a man with a strong sense of self, and thus begin to feel attraction for you."}\', 1364278860)');
mysql_query('INSERT INTO `quotes` VALUES(24, 1, \'{"name":"Richard La Ruina (Gambler)","quote":"Most guys fidget. They\\u2019re nervous, and it shows. Their weight shifts from leg to leg. When they\\u2019re out at a bar, they hold their drinks up close to their chest and frequently take sips. They don\\u2019t take up much physical space, literally. And that\\u2019s when they\\u2019re by themselves. When they talk to women and other men, it gets worse: they\\u2019re afraid to touch, gesture, or show much expression--on top of the nervous movements already described. All of these are nonverbal signs of low status."}\', 1364278894)');
mysql_query('INSERT INTO `quotes` VALUES(25, 1, \'{"name":"Richard La Ruina (Gambler)","quote":"There is a little loophole in human psychology: whoever is most certain wins. In other words, when multiple people have multiple ideas or viewpoints, the person who believes most certainly that he or she is correct will generally win out and influence others. Those who have relatively little in the way of an opinion will look to the person who is most certain to make decisions for them. Just realizing this one simple fact makes a world of difference. Approach the world with the idea that \\u201cwhoever is most certain wins,\\u201d and you will find that you get very different results."}\', 1364278914)');
mysql_query('INSERT INTO `quotes` VALUES(26, 1, \'{"name":"Richard La Ruina (Gambler)","quote":"Just as you must hold your power with the men around you, you must exercise it when in the presence of women as well. The more beautiful the woman, the more she\\u2019s used to being given all the status. A deferential man will ask her to make decisions on everything, from whether it\\u2019s okay to take her phone number and when she\\u2019s available to meet, to where she would like to go, whether his clothes are okay, and if the food at a proposed restaurant is good. This is actually unattractive. It\\u2019s so common for men to give away all their power like this that the rare man who doesn\'t is prized."}\', 1364278929)');
mysql_query('INSERT INTO `quotes` VALUES(27, 1, \'{"name":"Richard La Ruina (Gambler)","quote":"The primary component of social intelligence is the ability to connect and communicate with others--in other words, basic social skills. A socially intelligent man knows how others around him feel at all times. He understands the status hierarchies, the power dynamics, and the difference between cool and uncool."}\', 1364278932)');
mysql_query('INSERT INTO `quotes` VALUES(28, 1, \'{"name":"Nancy Friday","quote":"Traditionally, women wait to be asked, or acted upon. To reach out for the man you want is to be aggressive, and to reach out for the way you want him in bed isn\'t just aggressive, it\\u2019s unfeminine."}\', 1364279005)');
mysql_query('INSERT INTO `quotes` VALUES(29, 1, \'{"name":"Neil Strauss (Style)","quote":"To get a woman, you have to be willing to risk losing her."}\', 1364279027)');
mysql_query('INSERT INTO `quotes` VALUES(30, 1, \'{"name":"Neil Strauss (Style)","quote":"You may have missed your window because now she\'s with a guy. But go and approach her anyway. It\'s a two set."}\', 1364279122)');
mysql_query('INSERT INTO `quotes` VALUES(31, 1, \'{"name":"Neil Strauss (Style)","quote":"Don\'t even think about it and just do it. If you don\'t, you\'ll be regretting it the rest of the weekend."}\', 1364279161)');
mysql_query('INSERT INTO `quotes` VALUES(32, 1, \'{"name":"Neil Strauss (Style)","quote":"Attraction is not an option."}\', 1364279173)');
mysql_query('INSERT INTO `quotes` VALUES(33, 1, \'{"name":"Neil Strauss (Style)","quote":"It\\u2019s not lying, it\\u2019s flirting."}\', 1364279183)');
mysql_query('INSERT INTO `quotes` VALUES(34, 1, \'{"name":"Neil Strauss (Style)","quote":"We have this idea that love is supposed to last forever. But love isn\'t like that. It\'s a free-flowing energy that comes and goes when it pleases. Sometimes, it stays for life; other times it stays for a second, a day, a month or a year. So don\'t fear love when it comes simply because it makes you vulnerable. But don\'t be surprised when it leaves either. Just be glad you had the opportunity to experience it."}\', 1364279198)');
mysql_query('INSERT INTO `quotes` VALUES(35, 1, \'{"name":"Neil Strauss (Style)","quote":"In life, people tend to wait for good things to come to them. And by waiting, they miss out. Usually, what you wish for doesn\'t fall in your lap; it falls somewhere nearby, and you have to recognize it, stand up, and put in the time and work it takes to get to it. This isn\'t because the universe is cruel. It\'s because the universe is smart. It has its own cat-string theory and knows we don\'t appreciate things that fall into our laps."}\', 1364279213)');
mysql_query('INSERT INTO `quotes` VALUES(36, 1, \'{"name":"Neil Strauss (Style)","quote":"Without commitment, you cannot have depth in anything, whether it\'s a relationship, a business or a hobby."}\', 1364279231)');
mysql_query('INSERT INTO `quotes` VALUES(37, 1, \'{"name":"Neil Strauss (Style)","quote":"We make fun of those we\'re most scared of becoming."}\', 1364279248)');
mysql_query('INSERT INTO `quotes` VALUES(38, 1, \'{"name":"Neil Strauss (Style)","quote":"A lot of people make the mistake of trying to defend principles in relationships. My goal is long-term happiness. And I make choices that aren\'t going to undermine that goal."}\', 1364279254)');
mysql_query('INSERT INTO `quotes` VALUES(39, 1, \'{"name":"Neil Strauss (Style)","quote":"What most of us present to the world isn\'t necessarily our true self: It\\u2019s a combination of years of bad habits and fear-based behavior.Our real self lies buried underneath all the insecurities and inhibitions. So rather than just being yourself, focus on discovering and permanently bringing to the surface your best self."}\', 1364279280)');
mysql_query('INSERT INTO `quotes` VALUES(40, 1, \'{"name":"Neil Strauss (Style)","quote":"Most guys who define themselves as \\\\\\"too nice\\\\\\" only behave nicely because they want everybody to like them and don\\u2019t want anyone to think badly of them. Don\\u2019t mistake being fearful and weak-minded for being nice."}\', 1364279292)');
mysql_query('INSERT INTO `quotes` VALUES(41, 1, \'{"name":"Neil Strauss (Style)","quote":"In order to excel at anything, there are always hurdles, obstacles, or challenges one must get past. It\'s what bodybuilders call the pain period. Those who push themselves, and are willing to face pain, exhaustion, humiliation, rejection, or worse, are the ones who become champions. The rest are left on the sidelines."}\', 1364279308)');
mysql_query('INSERT INTO `quotes` VALUES(42, 1, \'{"name":"Neil Strauss (Style)","quote":"A man has two primary drives in early adulthood: one toward power, success, and accomplishment; the other toward love, companionship, and sex. Half of life then was out of order. To go before them was to stand up as a man and admit that I was only half a man."}\', 1364279325)');
mysql_query('INSERT INTO `quotes` VALUES(43, 1, \'{"name":"Stan Tayi (James Matador)","quote":"When you master these skills, you WILL feel like you have super powers. You will begin to see the world in a different set of lens. And you will no longer wish to go back to the life you used to have\\u2026"}\', 1364279353)');
mysql_query('INSERT INTO `quotes` VALUES(44, 1, \'{"name":"Stan Tayi (James Matador)","quote":"The No. 1 mistake average guys make with women is they communicate interest to women without showing value first."}\', 1364279391)');
mysql_query('INSERT INTO `quotes` VALUES(45, 1, \'{"name":"Stan Tayi (James Matador)","quote":"Things are not as they appear. Everything is transient no matter how great they seem. Over time, no matter how great the honeymoon was, a woman might see you as a threat if she thinks she is wasting her time with you. You have to always have value for your partner; it\\u2019s a way of being."}\', 1364279400)');
mysql_query('INSERT INTO `quotes` VALUES(46, 1, \'{"name":"Stan Tayi (James Matador)","quote":"Developing a meaningful relationship with a woman is a real process and it takes time. Listen to what is positively unique about that person. Prove that you\\u2019re an attractive guy and that you are filled with positive emotions. You need to really like her for who she is trying to be, for her attempt to be a successful woman, which is what is needed for a deep, meaningful relationship."}\', 1364279401)');
mysql_query('INSERT INTO `quotes` VALUES(47, 1, \'{"name":"Stan Tayi (James Matador)","quote":"Yes, we are all looking for that special someone, but now we are operating from a non-scarcity mentality. That makes us more pure than others\\u2026 we have the power to say no\\u2026"}\', 1364279401)');
mysql_query('INSERT INTO `quotes` VALUES(48, 1, \'{"name":"Stan Tayi (James Matador)","quote":"Life is about creating oneself and not waiting to find it."}\', 1364279402)');
mysql_query('INSERT INTO `quotes` VALUES(49, 1, \'{"name":"Erik von Markovik (Mystery)","quote":"Love is also pair-bonding: Quite simply, we have a mechanism in our brain that is evolutionary-calibrated to align with those who have high survival replication value for us. When a man is with a woman, all that he has to do is prove to her that he will stick around and that way she can have sex, and sex equates to babies and that is wired in our ancient circuitry. It doesn\'t mean she wants him to stick around, but that the choice is hers. Love is magic."}\', 1364279467)');
mysql_query('INSERT INTO `quotes` VALUES(50, 1, \'{"name":"Galileo Galilei","quote":"All truths are easy to understand once they are discovered; the point is to discover them."}\', 1364279511)');
mysql_query('INSERT INTO `quotes` VALUES(51, 1, \'{"name":"Winston Churchill","quote":"The truth is incontrovertible; malice may attack it, ignorance may deride it, but in the end, there it is."}\', 1364279526)');
mysql_query('INSERT INTO `quotes` VALUES(52, 1, \'{"name":"Gautama Buddha","quote":"There are only two mistakes one can make along the road to truth: not going all the way, and not starting."}\', 1364279557)');
mysql_query('INSERT INTO `quotes` VALUES(53, 1, \'{"name":"Gautama Buddha","quote":"You yourself, as much as anybody in the entire universe, deserve your love and affection."}\', 1364279583)');
mysql_query('INSERT INTO `quotes` VALUES(54, 1, \'{"name":"George Orwell","quote":"In a time of universal deceit, telling the truth is a revolutionary act."}\', 1364279599)');
mysql_query('INSERT INTO `quotes` VALUES(55, 1, \'{"name":"John F. Kennedy","quote":"The great enemy of the truth is very often not the lie, deliberate, contrived and dishonest, but the myth, persistent, persuasive and unrealistic."}\', 1364279607)');
mysql_query('INSERT INTO `quotes` VALUES(56, 1, \'{"name":"George Elliot","quote":"Falsehood is easy, truth so difficult."}\', 1364279622)');
mysql_query('INSERT INTO `quotes` VALUES(57, 1, \'{"name":"Mohandas Gandhi","quote":"Truth is by nature self-evident. As soon as you remove the cobwebs of ignorance that surround it, it shines clear."}\', 1364279633)');
mysql_query('INSERT INTO `quotes` VALUES(58, 1, \'{"name":"Jesus Christ","quote":"You will know the truth, and the truth will make you free."}\', 1364279645)');
mysql_query('INSERT INTO `quotes` VALUES(59, 1, \'{"name":"Arthur Conan Doyle","quote":"When you have eliminated the impossible, whatever remains, however improbable, must be the truth."}\', 1364279658)');
mysql_query('INSERT INTO `quotes` VALUES(60, 1, \'{"name":"John Keats","quote":"Beauty is truth, truth beauty - that is all ye know on earth, and all ye need to know."}\', 1364279675)');
mysql_query('INSERT INTO `quotes` VALUES(61, 1, \'{"name":"Henry David Thoreau","quote":"It takes two to speak truth -- one to speak, and another to hear."}\', 1364279686)');
mysql_query('INSERT INTO `quotes` VALUES(62, 1, \'{"name":"Albert Einstein","quote":"Truth is what stands the test of experience. A man should look for what is and not for what he thinks should be."}\', 1364279729)');
mysql_query('INSERT INTO `quotes` VALUES(63, 1, \'{"name":"David DeAngelo","quote":"Attraction is not a choice."}\', 1364279761)');
mysql_query('INSERT INTO `quotes` VALUES(64, 1, \'{"name":"David DeAngelo","quote":"Little boys tease little girls when they\\u2019re 8, and women still love it when they\\u2019re 28 and 48."}\', 1364279770)');
mysql_query('INSERT INTO `quotes` VALUES(65, 1, \'{"name":"David DeAngelo","quote":"If you say to a woman \"I really like you\", it won\'t be as effective as saying to them \"You really like me\" in a teasing way. Do you understand?"}\', 1364279776)');
mysql_query('INSERT INTO `quotes` VALUES(66, 1, \'{"name":"David DeAngelo","quote":"I don\'t care if you\'re four feet tall and have one eye. If you can make women laugh consistently and get those good feelings flowing through them, they\'ll love you."}\', 1364279777)');
mysql_query('INSERT INTO `quotes` VALUES(67, 1, \'{"name":"David DeAngelo","quote":"The masculine man says \"No\" to a woman calmly. The asshole says \"No\" to a woman in an angry tone."}\', 1364279778)');
mysql_query('INSERT INTO `quotes` VALUES(68, 1, \'{"name":"David DeAngelo","quote":"One book that I read called \\u2018Comedy Writing Secrets\\u2019 by Helitzer made a great point. He said that most of being funny is the character and not the jokes."}\', 1364279778)');
mysql_query('INSERT INTO `quotes` VALUES(69, 1, \'{"name":"Nick Braddock","quote":"You are - in many ways - the sum of the five people you spend the most time with."}\', 1364279837)');
mysql_query('INSERT INTO `quotes` VALUES(70, 1, \'{"name":"Dale Carnegie","quote":"It\'s much easier to become interested in others than it is to convince them to be interested in you."}\', 1364279852)');
mysql_query('INSERT INTO `quotes` VALUES(71, 1, \'{"name":"Ross Jeffries","quote":"Every decision people make is based in and dependent on their state of mind. If you don\\u2019t like their decision, change their state of mind."}\', 1364279853)');
mysql_query('INSERT INTO `quotes` VALUES(72, 1, \'{"name":"Ross Jeffries","quote":"If all you learn to do is really begin to live the attitude that there are no failures, only learnings, you will be ahead of 99 percent of the people in society."}\', 1364279853)');
mysql_query('INSERT INTO `quotes` VALUES(73, 1, \'{"name":"Anais Nin","quote":"We don\'t see things as they are, we see them as we are."}\', 1364279890)');
mysql_query('INSERT INTO `quotes` VALUES(74, 1, \'{"name":"Anais Nin","quote":"Life shrinks or expands in proportion to one\'s courage."}\', 1364279930)');
mysql_query('INSERT INTO `quotes` VALUES(75, 1, \'{"name":"Anais Nin","quote":"Each contact with a human being is so rare, so precious, one should preserve it."}\', 1364279931)');
mysql_query('INSERT INTO `quotes` VALUES(76, 1, \'{"name":"Anais Nin","quote":"The possession of knowledge does not kill the sense of wonder and mystery. There is always more mystery."}\', 1364279932)');
mysql_query('INSERT INTO `quotes` VALUES(77, 1, \'{"name":"Anais Nin","quote":"I, with a deeper instinct, choose a man who compels my strength, who makes enormous demands on me, who does not doubt my courage or my toughness, who does not believe me naive or innocent, who has the courage to treat me like a woman."}\', 1364279932)');
mysql_query('INSERT INTO `quotes` VALUES(78, 1, \'{"name":"Anais Nin","quote":"How wrong it is for a woman to expect the man to build the world she wants, rather than to create it herself."}\', 1364279933)');
mysql_query('INSERT INTO `quotes` VALUES(79, 1, \'{"name":"Anais Nin","quote":"Life is truly known only to those who suffer, lose, endure adversity and stumble from defeat to defeat."}\', 1364279933)');
mysql_query('INSERT INTO `quotes` VALUES(80, 1, \'{"name":"Nick Savoy","quote":"Telling someone to \\\\\\"be natural\\\\\\" is like telling someone to \\\\\\"be rich\\\\\\" in finance. Being natural is the destination, not how you get there."}\', 1364279999)');
mysql_query('INSERT INTO `quotes` VALUES(81, 1, \'{"name":"Julian Treasure","quote":"We spend roughly 60 percent of our communication time listening, but we\\u2019re not very good at it. We retain just 25 percent of what we hear."}\', 1364280021)');
mysql_query('INSERT INTO `quotes` VALUES(82, 1, \'{"name":"Julian Treasure","quote":"We are losing our listening."}\', 1364280023)');
mysql_query('INSERT INTO `quotes` VALUES(83, 1, \'{"name":"Julian Treasure","quote":"I believe everyone needs to listen consciously in order to live fully."}\', 1364280023)');
mysql_query('INSERT INTO `quotes` VALUES(84, 1, \'{"name":"Julian Treasure","quote":"Everyday I\\u2019m going to listen to you as if it\\u2019s the first time."}\', 1364280024)');
mysql_query('INSERT INTO `quotes` VALUES(85, 1, \'{"name":"Brian Greene","quote":"You see we learned that our universe is not static that space is expanding and that that expansion is speeding up and that there might be other universes all by carefully examining faint pinpoints of starlight coming to us from distant galaxies. But because the expansion is speeding up in the very far future those galaxies will rush away so far and so fast that we won\'t be able to see them not because of technological limitations but because of the laws of physics. The light those galaxies emit even traveling at the fastest speed, the speed of light, will not be able to overcome the ever widening gulf between us. So astronomers in the far future looking out into deep space will see nothing but an endless stretch of static inky black stillness and they will conclude that the Universe is static and unchanging and populated by a single central oasis of matter that they inhabit. A picture of the cosmos that we definitively know to be wrong. Know maybe those future astronomers will have records handed down from an earlier era, like ours, attesting to an expanding cosmos teeming with galaxies but would those future astronomers believe such ancient knowledge or would they believe in the black static empty Universe that their own state of the art observations reveal. I suspect the later. Which means that we are living through a remarkably privileged era. When certain deep truths about the cosmos are still within reach of the human spirit of exploration it appears that it may not always be that way. Because today\'s astronomers by turning powerful telescopes to the sky have captured a handful of starkly informative photons a kind of cosmic telegram billions of years in transit and the message echoing across the ages is clear. Sometimes nature guards her secrets with the unbreakable grip of physical law. Sometimes the true nature of reality beckons from just beyond the horizon."}\', 1364280477)');
mysql_query('INSERT INTO `quotes` VALUES(86, 1, \'{"name":"Antoine de Saint-Exupery","quote":"If you want to build a ship, don\'t drum up people together to collect wood and don\'t assign them tasks and work, but rather teach them to long for the endless immensity of the sea."}\', 1364280489)');
mysql_query('INSERT INTO `quotes` VALUES(87, 1, \'{"name":"Neil deGrasse Tyson","quote":"Recognize that the very molecules that make up your body, the atoms that construct the molecules, are traceable to the crucibles that were once the centers of high mass stars that exploded their chemically rich guts into the galaxy, enriching pristine gas clouds with the chemistry of life. So that we are all connected to each other biologically, to the earth chemically and to the rest of the universe atomically. That\\u2019s kinda cool! That makes me smile and I actually feel quite large at the end of that. It\\u2019s not that we are better than the universe, we are part of the universe. We are in the universe and the universe is in us."}\', 1364280507)');
mysql_query('INSERT INTO `quotes` VALUES(88, 1, \'{"name":"Neil deGrasse Tyson","quote":"Where ignorance lurks, so too do the frontiers of discovery and imagination."}\', 1364280523)');
mysql_query('INSERT INTO `quotes` VALUES(89, 1, \'{"name":"Neil deGrasse Tyson","quote":"Again and again across the centuries, cosmic discoveries have demoted our self-image. Earth was once assumed to be astronomically unique, until astronomers learned that Earth is just another planet orbiting the Sun. Then we presumed the Sun was unique, until we learned that the countless stars of the night sky are suns themselves. Then we presumed our galaxy, the Milky Way, was the entire known universe, until we established that the countless fuzzy things in the sky are other galaxies, dotting the landscape of our known universe. Today, how easy it is to presume that one universe is all there is. Yet emerging theories of modern cosmology, as well as the continually reaffirmed improbability that anything is unique, require that we remain open to the latest assault on our plea for distinctiveness: multiple universes, otherwise known as the \\u201cmultiverse,\\u201d in which ours is just one of countless bubbles bursting forth from the fabric of the cosmos."}\', 1364280523)');
mysql_query('INSERT INTO `quotes` VALUES(90, 1, \'{"name":"Neil deGrasse Tyson","quote":"But you can\\u2019t be a scientist if you\\u2019re uncomfortable with ignorance, because scientists live at the boundary between what is known and unknown in the cosmos. This is very different from the way journalists portray us. So many articles begin, \\u201cScientists now have to go back to the drawing board.\\u201d It\\u2019s as though we\\u2019re sitting in our offices, feet up on our desks\\u2014masters of the universe\\u2014and suddenly say, \\u201cOops, somebody discovered something!\\u201d No. We\\u2019re always at the drawing board. If you\\u2019re not at the drawing board, you\\u2019re not making discoveries. You\\u2019re not a scientist; you\\u2019re something else. The public, on the other hand, seems to demand conclusive explanations as they leap without hesitation from statements of abject ignorance to statements of absolute certainty."}\', 1364280524)');
mysql_query('INSERT INTO `quotes` VALUES(91, 1, \'{"name":"Professor Brian Cox","quote":"As it [the Sun] begins to run out of fuel, its core will collapse, and the extra heat this generates will cause its outer layers to expand. In around a billion years time this will have a catastrophic effect on our fragile world. In 6 billion years our Sun will explode. The fate of the sun is the same as for all stars, one day they all must die and the cosmos will be plunged into eternal night. As the age of starlight ends, all but the dimmest flicker of light in the universe will go out. The faint glow of white-dwarfs will provide the only illumination in a dark and empty void, littered with dead stars and black holes. By this point the universe will be a hundred-trillion years old."}\', 1364280582)');
mysql_query('INSERT INTO `quotes` VALUES(92, 1, \'{"name":"Professor Brian Cox","quote":"[Black dwarves are] White dwarfs that have become so cold they barely emit any heat or light. Black dwarves are dark dense decaying balls of degenerate matter, little more than the ashes of stars. With the black dwarves gone, there won\\u2019t be a single atom of matter left. All that will remain of our once rich cosmos will be particles of light, and black holes. After an unimaginable length of time even the black holes will have evaporated and the universe will be nothing but a sea of photons gradually tending towards the same temperature \\u2026 absolute zero."}\', 1364280582)');
mysql_query('INSERT INTO `quotes` VALUES(93, 1, \'{"name":"Professor Brian Cox","quote":"The story of the universe finally comes to an end. For the first time in its life, the universe will be permanent and unchanging. Entropy finally stops increasing because the cosmos cannot get any more disordered. Nothing happens, and it keeps not happening, forever. It\\u2019s what\\u2019s known as the heat-death of the universe. An era when the cosmos will remain vast and cold and desolate for the rest of time \\u2026 the arrow of time has simply ceased to exist. It\\u2019s an inescapable fact of the universe written into the fundamental laws of physics, the entire cosmos will die."}\', 1364280583)');
mysql_query('INSERT INTO `quotes` VALUES(94, 1, \'{"name":"Professor Brian Cox","quote":"In this diamond there are 3 million billion billion carbon atoms. So this is a diamond size box of carbon atoms. And there\'s the thing the Pauli exclusion principle still applies. So all the energy levels in all those 3 million billion billion atoms have to be slightly different in order to ensure that none of the electrons sit in precisely the same energy level. Pauli\'s principle holds fast but it doesn\'t stop with the diamond. See, you can think of the whole universe as a vast box of atoms with countless numbers of energy levels all filled by countless numbers of electrons. So here\'s the amazing thing. The exclusion principle still applies so none of the electrons in the universe can sit in precisely the same energy level. But that must mean something very odd. See let me take this diamond and let me just heat it up a little bit between my hands just gently warming it up. I\'m putting a bit of energy into it so I\'m shifting the electrons around some of the electrons are jumping into different energy levels. But this shift in the configuration of the electrons inside the diamond has consequences because the sum total of all the electrons in the universe must respect Pauli. Therefore every electron around every atom in the universe must be shifting as I heat the diamond up to make sure that none of them end up in the same energy level. When I heat this diamond up all the electrons across the universe instantly but imperceptibly change their energy levels. So everything is connected to everything else."}\', 1364280583)');
mysql_query('INSERT INTO `quotes` VALUES(96, 1, \'{"name":"Arthur Schopenhauer","quote":"Everyone takes the limits of his own vision for the limits of the world."}\', 1364415931)');
 
}
?>
