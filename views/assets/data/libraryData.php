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
                    "file" => "../assets/data/library/Ceiling_Frescoes.png",
                    "religion" => "Christianity",
                    "category" => ["Historical Context"],
                    "description" => "This monumental fresco portrays various episodes from the life of St. Charles Borromeo and the triumph of the Catholic Church. It showcases the glory of the Baroque era and the spiritual power of the Catholic faith.",
                    "author" => "Johann Michael Rottmayr"
                ],
                "LP2" => [
                    "title" => "Gautama Buddha",
                    "file" => "../assets/data/library/Gautama_Buddha.png",
                    "religion" => "Buddhism",
                    "category" => ["Religious Practices"],
                    "description" => "Gautama Buddha, also known as Siddhartha Gautama, was a spiritual leader and the founder of Buddhism. His teachings and philosophy have had a profound and lasting impact on millions of people around the world.",
                    "author" => "Jose Luis Sanchez"
                ],  
                // "Photo 3" => [
                //     "file" => "",
                //     "religion" => "",
                //     "category" => ["", ""],
                //     "description" => "",
                //     "author" => ""
                // ],    
                // "Photo 4" => [
                //     "file" => "",
                //     "religion" => "",
                //     "category" => ["", ""],
                //     "description" => "",
                //     "author" => ""
                // ],    
                // "Photo 5" => [
                //     "file" => "",
                    // "religion" => "",
                //     "category" => ["", ""],
                //     "description" => "",
                //     "author" => ""
                // ]  
            ],
            "videos" => [
                "LV1" => [
                    "title" => "Mosque",
                    "file" => "../assets/data/library/Mosque.mp4",
                    "religion" => "Islam",
                    "category" => ["Religious Practices"],
                    "description" => "A mosque is a place of worship and community for followers of Islam. It is typically a building where Muslims gather for congregational prayers, engage in spiritual activities, seek religious guidance, and foster community bonds. ",
                    "author" => "Ali Karim"
                ],
                "LV2" => [
                    "title" => "Hindu Event",
                    "file" => "../assets/data/library/Hindu_Event.mp4",
                    "religion" => "Hinduism",
                    "category" => ["Religious Practices"],
                    "description" => "Hindu events encompass a rich tapestry of religious, cultural, and traditional celebrations that hold significant importance for followers of Hinduism. These events are often marked by elaborate rituals, vibrant festivities, and communal gatherings, creating an atmosphere of joy, devotion, and spiritual connection.",
                    "author" => "Abhilash Bahirat"
                ],  
                // "Video 3" => [
                //     "file" => "",
                //     "religion" => "",
                //     "category" => ["", ""],
                //     "description" => "",
                //     "author" => ""
                // ],    
                // "Video 4" => [
                //     "file" => "",
                //     "religion" => "",
                //     "category" => ["", ""],
                //     "description" => "",
                //     "author" => ""
                // ],    
                // "Video 5" => [
                //     "file" => "",
                //     "religion" => "",
                //     "category" => ["", ""],
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
                    "source" => "https://www.pewresearch.org/religion/2018/05/29/being-christian-in-western-europe/"
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
                    "title" => "Ganesh Chaturthi (Vinayaka Chathurthi)",
                    "resourceImg" => "../assets/data/library/LR10.jpg",
                    "type" => "article",
                    "author" => "P. Punarvasu",
                    "date" => "2023",
                    "religion" => "Hinduism",
                    "category" => ["Religious Practices"],
                    "source" => "https://www.indastro.com/astrology-articles/what-significance-ganesh-chaturthi.html"
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