<?php
class libraryData {

    public function getBasicInfo() {
        $libraryBasicInfo = [
            "Buddhism" => [
                "borderLeftImg" => "../assets/img/buddhism-border-left.png",
                "borderRightImg" => "../assets/img/buddhism-border-right.png",
                "religionDesc" => "Buddhism is based on the principles of the Four Noble Truths, which acknowledge the existence of suffering, its causes, and path to liberation. Buddhists follow the Eightfold Path, a set of guidelines for ethical living and meditation practices, with the ultimate goal of attaining enlightenment and ending the cycle of rebirth.",
                "sacredScripture" => "The Tripitaka",
                "sacredScriptureImg" => "../assets/img/tripitaka.png",
                "sacredScriptureDesc" => "The Tripitaka comprises the Vinaya, Sutta, and Abhidhamma.",
                "placeOfWorship" => "The Temple",
                "placeOfWorshipImg" => "../assets/img/temple.png",
                "placeOfWorshipDesc" => "The Buddhist temple is where believers in meditate, pray, and perform rituals.",
                "sacredSymbol" => "The Dharma Wheel",
                "sacredSymbolImg" => "../assets/img/lib-buddhism.png",
                "sacredSymbolDesc"=> "The Dharma Wheel (Dharmachakra), represents the path to enlightenment."
            ],
            "Christianity" => [
                "borderLeftImg" => "../assets/img/christianity-border-left.png",
                "borderRightImg" => "../assets/img/christianity-border-right.png",
                "religionDesc" => "Christianity is a monotheistic religion based on the life, teachings, death, and resurrection of Jesus Christ. It is centered around the belief in Jesus as the Son of God and the savior of humanity. Christians strive to live a life of faith, love, and service guided by the principles of Christ's teachings.",
                "sacredScripture" => "The Bible",
                "sacredScriptureImg" => "../assets/img/bible.png",
                "sacredScriptureDesc" => "The Bible comprises the Old Testament and the New Testament.",
                "placeOfWorship" => "The Church",
                "placeOfWorshipImg" => "../assets/img/church.png",
                "placeOfWorshipDesc" => "The Christian Church is for worship, fellowship, and the practice of faith.",
                "sacredSymbol" => "The Crucifix",
                "sacredSymbolImg" => "../assets/img/crucifix.png",
                "sacredSymbolDesc"=> "The Crucifix is a symbol of the crucifixion of Jesus Christ."
            ],
            "Hinduism" => [
                "borderLeftImg" => "../assets/img/hinduism-border-left.png",
                "borderRightImg" => "../assets/img/hinduism-border-right.png",
                "religionDesc" => "Hinduism encompasses a wide range of beliefs, rituals, and practices, with a focus on dharma (righteous living), karma (action and consequence), and moksha (liberation from the cycle of rebirth). It recognizes multiple deities, but also emphasizes the ultimate reality of Brahman, the divine essence that pervades all existence.",
                "sacredScripture" => "The Veda",
                "sacredScriptureImg" => "../assets/img/veda.png",
                "sacredScriptureDesc" => "The Vedas show Hinduism religious and philosophical traditions.",
                "placeOfWorship" => "The Mandir",
                "placeOfWorshipImg" => "../assets/img/mandir.png",
                "placeOfWorshipDesc" => "The Mandir is the sacred temple for worship and spiritual connection.",
                "sacredSymbol" => "The Om",
                "sacredSymbolImg" => "../assets/img/lib-hinduism.png",
                "sacredSymbolDesc"=> "The Om is a sacred symbol and mantra representing the divine essence."
            ],
            "Islam" => [
                "borderLeftImg" => "../assets/img/islam-lantern-left.png",
                "borderRightImg" => "../assets/img/islam-lantern-right.png",
                "religionDesc" => "Islam is a monotheistic religion founded in the 7th century CE by the Prophet Muhammad. Its followers are known as Muslims. The Five Pillars of Islam—declaration of faith, prayer, fasting, giving to charity, and pilgrimage to Mecca—form the core principles and practices of the faith.",
                "sacredScripture" => "The Quran",
                "sacredScriptureImg" => "../assets/img/quran.png",
                "sacredScriptureDesc" => "The Quran is the word of God as revealed to the Prophet Muhammad.",
                "placeOfWorship" => "The Mosque",
                "placeOfWorshipImg" => "../assets/img/mosque.png",
                "placeOfWorshipDesc" => "The Mosque is a place of worship for Muslims, where they gather for worship.",
                "sacredSymbol" => "Star and Crescent",
                "sacredSymbolImg" => "../assets/img/lib-islam.png",
                "sacredSymbolDesc"=> "Star and Crescent symbolize the Five Pillars and the creator's greatness."
            ],
            "Judaism" => [
                "borderLeftImg" => "../assets/img/judaism-border-left.png",
                "borderRightImg" => "../assets/img/judaism-border-left.png",
                "religionDesc" => "Judaism is the world's oldest monotheistic religion, dating back nearly 4,000 years. Followers of Judaism believe in one God who revealed himself through ancient prophets. Judaism is the complex phenomenon of a total way of life for the Jewish people, comprising theology, law, and innumerable cultural traditions.",
                "sacredScripture" => "The Tanakh",
                "sacredScriptureImg" => "../assets/img/tanakh.png",
                "sacredScriptureDesc" => "The Hebrew Bible comprising of the Torah, Nevi'im, and Ketuvim.",
                "placeOfWorship" => "The Synagogue",
                "placeOfWorshipImg" => "../assets/img/synagogue.png",
                "placeOfWorshipDesc" => "The Jewish place for gathering, prayer, and community engagement.",
                "sacredSymbol" => "The Menorah",
                "sacredSymbolImg" => "../assets/img/menorah.png",
                "sacredSymbolDesc"=> "A multi-branched candelabra, used in the religious rituals of Judaism."
            ]
        ];

        return $libraryBasicInfo;
    }

    public function getResources() {
        $libraryResources = [
            "photos" => [
                "LP1" => [
                    "title" => "Ceiling Frescoes",
                    "file" => "../assets/data/library/LP1.png",
                    "religion" => "Christianity",
                    "category" => ["Historical Context"],
                    "description" => "This monumental fresco portrays various episodes from the life of St. Charles Borromeo and the triumph of the Catholic Church. It showcases the glory of the Baroque era and the spiritual power of the Catholic faith.",
                    "author" => "Johann Michael Rottmayr"
                ],
                "LP2" => [
                    "title" => "Gautama Buddha",
                    "file" => "../assets/data/library/LP2.png",
                    "religion" => "Buddhism",
                    "category" => ["Religious Practices"],
                    "description" => "Gautama Buddha, also known as Siddhartha Gautama, was a spiritual leader and the founder of Buddhism. His teachings and philosophy have had a profound and lasting impact on millions of people around the world.",
                    "author" => "Jose Luis Sanchez"
                ],  
                "LP3" => [
                    "title" => "Hindu Gods and Deities (Lord Krishna)",
                    "file" => "../assets/data/library/LP3.jpg",
                    "religion" => "Hinduism",
                    "category" => ["Theology"],
                    "description" => "Lord Krishna is one of the most popular Gods in Hinduism. Krishna is considered the supreme deity, worshipped across many traditions of Hinduism in a variety of different perspectives. Krishna is recognized as the eighth incarnation (avatar) of Lord Vishnu, and one and the same as Lord Vishnu, one of the trimurti and as the supreme god in his own right.",
                    "author" => ""
                ],
                "LP4" => [
                    "title" => "Courtyard of the Jama Mosque, Isfahan",
                    "file" => "../assets/data/library/LP4.avif",
                    "religion" => "Islam",
                    "category" => ["Religious Practices"],
                    "description" => "Located in the historic centre of Isfahan, the Masjed-e Jāmé (Friday mosque) can be seen as a stunning illustration of the evolution of mosque architecture over twelve centuries, starting in ad 841. It is the oldest preserved edifice of its type in Iran and a prototype for later mosque designs throughout Central Asia. ",
                    "author" => "Eugène Flandin"
                ],
                "LP5" => [
                    "title" => "Mohammed and the first four Caliphs",
                    "file" => "../assets/data/library/LP5.avif",
                    "religion" => "Islam",
                    "category" => ["Religious Practices"],
                    "description" => "The Early period in Islam's socio-political history and art is estimated to be around 640 to 900 CE. This falls just after Mohammad's death, which was in the year 632 CE. After Mohammad's death, four Caliphs were appointed as his successors, known as the “Rightly Guided Caliphs” - Caliphs are rulers within what is known as the caliphate, which is a state under Islamic rule.",
                    "author" => ""
                ],
                "LP6" => [
                    "title" => "Vishnu Laying on this Serpent",
                    "file" => "../assets/data/library/LP6.jpg",
                    "religion" => "Hinduism",
                    "category" => ["Theology"],
                    "description" => "The Vishnu Anantasayana panel, Dashavatara Temple, Deogarh. 5th-6th century CE. The Gupta-period sculpture adorning the temple includes many images from Hindu mythology. This celebrated panel from the south wall of the temple has Vishnu reclining on the serpent Ananta and floating on the waters of oblivion. Above him, seated on a lotus leaf, is the Hindu creator god Brahma. Lakshmi, the wife of Vishnu, massages his feet.",
                    "author" => ""
                ],
                "LP7" => [
                    "title" => "Pietà",
                    "file" => "../assets/data/library/LP7.webp",
                    "religion" => "Christianity",
                    "category" => ["Theology"],
                    "description" => "Pietà, as a theme in Christian art, depiction of the Virgin Mary supporting the body of the dead Christ. Some representations of the Pietà include John the Apostle, Mary Magdalene, and sometimes other figures on either side of the Virgin, but the great majority show only Mary and her Son.",
                    "author" => "Michelangelo"
                ],
                "LP8" => [
                    "title" => "Standing Maitreya",
                    "file" => "../assets/data/library/LP8.jpg",
                    "religion" => "Buddhism",
                    "category" => ["Theology"],
                    "description" => "The figure of Maitreya is seen standing on a lotus pedestal. From the position of the broken right hand it appears that originally it was in abhaya mudra. The left hand, which hangs down carries a vessel. The figure is characterized by the usual features of Gandhara images such as the mark of urna on the forehead, the moustache, all the ornaments, the heavy folds of the drapery and the scalloped aureole. Noteworthy features are the absence of a pair of sandals on his feet and the absence of a stupa in his coiffure.",
                    "author" => ""
                ],
                "LP9" => [
                    "title" => "Jews cross Red Sea pursued by Pharoah",
                    "file" => "../assets/data/library/LP9.jpg",
                    "religion" => "Judaism",
                    "category" => ["Theology"],
                    "description" => "The story of Jews crossing the Red Sea while being pursued by Pharaoh is a significant event in Jewish history and is a central part of the Passover narrative, as mentioned in the Hebrew Bible. This event is known as the Splitting of the Red Sea or the Parting of the Red Sea and is considered a pivotal moment in Jewish history. It symbolizes God's intervention in delivering the Jewish people from slavery and the beginning of their journey to the Promised Land.",
                    "author" => ""
                ],
                "LP10" => [
                    "title" => "The Birds' Head Haggadah",
                    "file" => "../assets/data/library/LP10.jpg",
                    "religion" => "Judaism",
                    "category" => ["Theology"],
                    "description" => "The Birds' Head Haggadah is a unique medieval Passover Haggadah, which is a Jewish text used during the Passover Seder. It is named after its distinctive feature, which is the illustrations of the human figures with bird-like heads, rather than the conventional human heads found in other Haggadot.",
                    "author" => ""
                ],
                // "" => [
                //     "title" => "",
                //     "file" => "../assets/data/library/LP6",
                //     "religion" => "",
                //     "category" => [""],
                //     "description" => "",
                //     "author" => ""
                // ]
            ],
            "videos" => [
                "LV1" => [
                    "title" => "Mosque",
                    "file" => "../assets/data/library/LV1.mp4",
                    "religion" => "Islam",
                    "category" => ["Religious Practices"],
                    "description" => "A mosque is a place of worship and community for followers of Islam. It is typically a building where Muslims gather for congregational prayers, engage in spiritual activities, seek religious guidance, and foster community bonds. ",
                    "author" => "Ali Karim"
                ],
                "LV2" => [
                    "title" => "Hindu Event",
                    "file" => "../assets/data/library/LV2.mp4",
                    "religion" => "Hinduism",
                    "category" => ["Religious Practices"],
                    "description" => "Hindu events encompass a rich tapestry of religious, cultural, and traditional celebrations that hold significant importance for followers of Hinduism. These events are often marked by elaborate rituals, vibrant festivities, and communal gatherings, creating an atmosphere of joy, devotion, and spiritual connection.",
                    "author" => ""
                ],
                "LV3" => [
                    "title" => "A Modern Jewish Family Celebrating Hanukkah",
                    "file" => "../assets/data/library/LV3.mp4",
                    "religion" => "Judaism",
                    "category" => ["Religious Practices"],
                    "description" => "A modern family celebrating Hanukkah gathers together in their home, bringing warmth and joy to the festival of lights. The family sets up a beautifully decorated Hanukkah menorah, with each member taking turns to light the candles each night.",
                    "author" => ""
                ],
                "LV4" => [
                    "title" => "Jews Praying In Front Of The Wailing Wall In Jerusalem",
                    "file" => "../assets/data/library/LV4.mp4",
                    "religion" => "Judaism",
                    "category" => ["Religious Practices"],
                    "description" => "Jews praying in front of the Wailing Wall in Jerusalem is a powerful and deeply spiritual sight. The Wailing Wall, also known as the Western Wall or the Kotel, is one of the most sacred sites in Judaism and holds significant historical and religious importance.",
                    "author" => "Jakob Lundvall"
                ],
                "LV5" => [
                    "title" => "Nativity Scene",
                    "file" => "../assets/data/library/LV5.mp4",
                    "religion" => "Christianity",
                    "category" => ["Religious Traditions"],
                    "description" => "A nativity scene, also known as a Christmas crib or creche, is a depiction of the birth of Jesus Christ as described in the Christian Bible's Gospels of Matthew and Luke. It is a traditional and popular Christmas decoration displayed in homes, churches, public places, and various settings during the Christmas season.",
                    "author" => "Gabe"
                ],
                "LV6" => [
                    "title" => "Tibetan Singing Bowl",
                    "file" => "../assets/data/library/LV6.mp4",
                    "religion" => "Buddhism",
                    "category" => ["Religious Practices"],
                    "description" => "A Tibetan Singing Bowl is a traditional musical instrument and meditative tool that originated in the Himalayan region, particularly in Tibet, Nepal, and India. These bowls are known for their unique sound, which is produced by striking or rubbing the outer rim of the bowl with a mallet.",
                    "author" => "Antoni Shkraba"
                ],
                "LV7" => [
                    "title" => "Salah",
                    "file" => "../assets/data/library/LV7.mp4",
                    "religion" => "Islam",
                    "category" => ["Religious Traditions", "Religious Practices"],
                    "description" => "Salah, also known as Salat, is the Islamic practice of ritual prayer and is one of the Five Pillars of Islam. It is an essential and mandatory act of worship for Muslims, performed five times a day at specified times. Salah is a means of establishing a direct connection with Allah (God) and is a significant way of expressing devotion and gratitude.",
                    "author" => "Michael Burrows"
                ],
                "LV8" => [
                    "title" => "House of Worship",
                    "file" => "../assets/data/library/LV8.mp4",
                    "religion" => "Christianity",
                    "category" => ["Religious Practices"],
                    "description" => "In Christianity, worship through song is a common and deeply cherished form of expressing devotion and praise to God. Singing and music have always played a central role in Christian worship, and it is an integral part of the church's liturgical and non-liturgical gatherings.",
                    "author" => "Luis Quintero"
                ],
                "LV9" => [
                    "title" => "Buddhist Altar",
                    "file" => "../assets/data/library/LV9.mp4",
                    "religion" => "Buddhism",
                    "category" => ["Religious Practices"],
                    "description" => "Kneeling in front of a Buddhist altar is a common act of reverence and devotion in Buddhist practices. The Buddhist altar, often called a shrine, is a sacred space where Buddhists place images or statues of the Buddha, Bodhisattvas, or revered teachers, as well as other symbolic items representing Buddhist principles and teachings.",
                    "author" => ""
                ],
                "LV10" => [
                    "title" => "Besakih Temple in Bali",
                    "file" => "../assets/data/library/LV10.mp4",
                    "religion" => "Hinduism",
                    "category" => ["Religious Practices"],
                    "description" => "Besakih Temple, also known as Pura Besakih, is the largest and most important Hindu temple in Bali, Indonesia. It is located on the southwestern slopes of Mount Agung, the highest volcano on the island and considered sacred by the Balinese people. The temple complex is situated in the village of Besakih, in the regency of Karangasem.",
                    "author" => "Mikhail Nilov"
                ],
                // "LV#" => [
                //     "title" => "",
                //     "file" => "../assets/data/library/LV#.mp4",
                //     "religion" => "",
                //     "category" => [""],
                //     "description" => "",
                //     "author" => ""
                // ]
            ],
            "readingMats" => [
                "LR1" => [
                    "title" => "Muharram Festival",
                    "resourceImg" => "../assets/data/library/LR1.jpg",
                    "type" => "article",
                    "author" => "Memphis Tours",
                    "date" => "n.d.",
                    "religion" => "Islam",
                    "category" => ["Religious Traditions"],
                    "source" => "https://www.memphistours.com/India/india-travel-guide/festivals-in-india/wiki/muharram-festival"
                ],
                "LR2" => [
                    "title" => "Celebrating Dhamma Day (Asalha Puja)",
                    "resourceImg" => "../assets/data/library/LR2.png",
                    "type" => "article",
                    "author" => "J. Kumara",
                    "date" => "2021",
                    "religion" => "Buddhism",
                    "category" => ["Religious Traditions"],
                    "source" => "https://www.givelify.com/blog/dhamma-day-asalha-puja/"
                ],
                "LR3" => [
                    "title" => "Being Christian in Western Europe",
                    "resourceImg" => "../assets/data/library/LR3.webp",
                    "type" => "article",
                    "author" => "Pew Research Center",
                    "date" => "2018",
                    "religion" => "Christianity",
                    "category" => ["Social Issues"],
                    "source" => "https://blogs.lse.ac.uk/religionglobalsociety/2018/06/pew-research-center-being-christian-in-western-europe/"
                ],
                "LR4" => [
                    "title" => "What it means to be a Christian in America",
                    "resourceImg" => "../assets/data/library/LR4.jpg",
                    "type" => "article",
                    "author" => "M. Bowman",
                    "date" => "2018",
                    "religion" => "Christianity",
                    "category" => ["Social Issues"],
                    "source" => "https://theconversation.com/what-it-means-to-be-a-christian-in-america-today-97981"
                ],  
                "LR5" => [
                    "title" => "African Christianity: Its public role",
                    "resourceImg" => "../assets/data/library/LR5.jpg",
                    "type" => "book",
                    "author" => "P. Gifford",
                    "date" => "1998",
                    "religion" => "Christianity",
                    "category" => ["Social Issues", "Historical Context"],
                    "source" => "https://books.google.com.ph/books/about/African_Christianity.html?id=SDS45RNq6ZkC&redir_esc=y"
                ],    
                "LR6" => [
                    "title" => "A History of Christianity in India: 1707 - 1858",
                    "resourceImg" => "../assets/data/library/LR6.jpg",
                    "type" => "book",
                    "author" => "S. Neil",
                    "date" => "2002",
                    "religion" => "Christianity",
                    "category" => ["Historical Context"],
                    "source" => "https://www.cambridge.org/us/universitypress/subjects/religion/church-history/history-christianity-india-17071858"
                ],
                "LR7" => [
                    "title" => "Fast of the 17th of Tammuz",
                    "resourceImg" => "../assets/data/library/LR7.jpg",
                    "type" => "article",
                    "author" => "The US",
                    "date" => "n.d.",
                    "religion" => "Judaism",
                    "category" => ["Religious Traditions"],
                    "source" => "https://theus.org.uk/article/fast-tammuz"
                ],
                "LR8" => [
                    "title" => "What is Obon?",
                    "resourceImg" => "../assets/data/library/LR8.jpg",
                    "type" => "article",
                    "author" => "East West",
                    "date" => "n.d.",
                    "religion" => "Buddhism",
                    "category" => ["Religious Traditions", "Religious Practices"],
                    "source" => "https://blog.eastwest.org/what-is-obon"
                ],
                "LR9" => [
                    "title" => "Assumption of the Blessed Virgin Mary",
                    "resourceImg" => "../assets/data/library/LR9.webp",
                    "type" => "article",
                    "author" => "My Catholic Life",
                    "date" => "n.d.",
                    "religion" => "Christianity",
                    "category" => ["Religious Traditions"],
                    "source" => "https://mycatholic.life/saints/saints-of-the-liturgical-year/august-15-assumption-of-the-blessed-virgin-mary/"
                ],
                "LR10" => [
                    "title" => "All About Ganesh Chaturthi",
                    "resourceImg" => "../assets/data/library/LR10.jpg",
                    "type" => "article",
                    "author" => "P. Punarvasu",
                    "date" => "2023",
                    "religion" => "Hinduism",
                    "category" => ["Religious Practices"],
                    "source" => "https://www.hinduamerican.org/all-about-ganesh-chaturthi"
                ],
                "LR11" => [
                    "title" => "The Book in the Jewish World, 1700-1900",
                    "resourceImg" => "../assets/data/library/LR11.jpg",
                    "type" => "book",
                    "author" => "Z. Gries",
                    "date" => "2007",
                    "religion" => "Judaism",
                    "category" => ["Historical Context"],
                    "source" => "https://books.google.com.ph/books/about/The_Book_in_the_Jewish_World.html?id=b4QsAAAAYAAJ&redir_esc=y"
                ],
                "LR12" => [
                    "title" => "The Foundations of Buddhism",
                    "resourceImg" => "../assets/data/library/LR12.jpg",
                    "type" => "book",
                    "author" => "R. Gethin",
                    "date" => "1998",
                    "religion" => "Buddhism",
                    "category" => ["Historical Context"],
                    "source" => "https://www.goodreads.com/en/book/show/149243"
                ],
                "LR13" => [
                    "title" => "An Introduction to Buddhism: Teachings, History and Practices",
                    "resourceImg" => "../assets/data/library/LR13.jpg",
                    "type" => "book",
                    "author" => "P. Harvey",
                    "date" => "2013",
                    "religion" => "Buddhism",
                    "category" => ["Religious Traditions", "Religious Practices"],
                    "source" => "https://books.google.com.ph/books/about/An_Introduction_to_Buddhism.html?id=u0sg9LV_rEgC&redir_esc=y"
                ],
                "LR14" => [
                    "title" => "Buddhism and the Definition of Religion: One More Time",
                    "resourceImg" => "../assets/data/library/LR14.jpeg",
                    "type" => "journal",
                    "author" => "W. Herbrechtsmeier",
                    "date" => "2013",
                    "religion" => "Buddhism",
                    "category" => ["Social Issues"],
                    "source" => "https://buddhism.lib.ntu.edu.tw/FULLTEXT/JR-ADM/herbre.htm"
                ],
                "LR15" => [
                    "title" => "What is the significance of All Saints Day?",
                    "resourceImg" => "../assets/data/library/LR15.png",
                    "type" => "article",
                    "author" => "The Basilica",
                    "date" => "2021",
                    "religion" => "Christianity",
                    "category" => ["Religious Traditions"],
                    "source" => "https://www.nationalshrine.org/blog/what-is-the-significance-of-all-saints-day/"
                ],
                "LR16" => [
                    "title" => "Bhai Duj",
                    "resourceImg" => "../assets/data/library/LR16.png",
                    "type" => "article",
                    "author" => "n.a.",
                    "date" => "n.d.",
                    "religion" => "Hinduism",
                    "category" => ["Religious Traditions", "Religious Practices"],
                    "source" => "https://pujayagna.com/blogs/hindu-festivals/bhai-dooj-festival"
                ],
                "LR17" => [
                    "title" => "Hanukkah 101",
                    "resourceImg" => "../assets/data/library/LR17.jpg",
                    "type" => "article",
                    "author" => "My Jewish Learning",
                    "date" => "n.d.",
                    "religion" => "Judaism",
                    "category" => ["Religious Traditions", "Religious Practices"],
                    "source" => "https://www.myjewishlearning.com/article/hanukkah-101/"
                ],
                "LR18" => [
                    "title" => "Animals in Islamic Tradition and Muslim Cultures",
                    "resourceImg" => "../assets/data/library/LR18.jpg",
                    "type" => "book",
                    "author" => "R. Foltz",
                    "date" => "2006",
                    "religion" => "Islam",
                    "category" => ["Religious Traditions"],
                    "source" => "https://www.simonandschuster.com/books/Animals-in-Islamic-Tradition-and-Muslim-Cultures/Richard-Foltz/9781851683987"
                ],
                "LR19" => [
                    "title" => "Islamophobia and the Politics of Empire",
                    "resourceImg" => "../assets/data/library/LR19.jpg",
                    "type" => "book",
                    "author" => "D. Kumar",
                    "date" => "2012",
                    "religion" => "Islam",
                    "category" => ["Social Issues"],
                    "source" => "https://books.google.com.ph/books/about/Islamophobia_and_the_Politics_of_Empire.html?id=j7BMcQ4tLZAC&redir_esc=y"
                ],
                "LR20" => [
                    "title" => "Hinduism and Globalization",
                    "resourceImg" => "../assets/data/library/LR20.jpg",
                    "type" => "journal",
                    "author" => "R. Singh & M. Aktor",
                    "date" => "2015",
                    "religion" => "Hinduism",
                    "category" => ["Social Issues"],
                    "source" => "https://link.springer.com/chapter/10.1007/978-94-017-9376-6_100"
                ],
                "LR21" => [
                    "title" => "Introduction to Islamic Theology and Law",
                    "resourceImg" => "../assets/data/library/LR21.jpg",
                    "type" => "book",
                    "author" => "I. Goldziher",
                    "date" => "1981",
                    "religion" => "Islam",
                    "category" => ["Theology"],
                    "source" => "https://bahai-library.com/goldziher_islamic_theology_law"
                ],
                "LR22" => [
                    "title" => "Hinduism and Environmental Ethics: Law, Literature, and Philosophy",
                    "resourceImg" => "../assets/data/library/LR22.jpg",
                    "type" => "book",
                    "author" => "C. Framarin",
                    "date" => "2014",
                    "religion" => "Hinduism",
                    "category" => ["Ethics"],
                    "source" => "https://books.google.com.ph/books?id=oLPpAgAAQBAJ&printsec=frontcover&redir_esc=y#v=onepage&q&f=false"
                ],
                
                // "Placeholder" => [
                //     "title" => "",
                //     "resourceImg" => "",
                //     "type" => "",
                //     "author" => "",
                //     "date" => "",
                //     "religion" => "",
                //     "category" => ["Religious Traditions"],
                //     "source" => ""
                // ]
            ]
        ];

        return $libraryResources;

    }

}

?>