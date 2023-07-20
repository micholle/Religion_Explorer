<?php

class mapData {

    // public function getMapPopulation() {
        // $mapPopulation = [
        //     "2010" => [
        //         "Akrotiri" => [
        //                 "Buddhism" => 0,
        //                 "Christianity" => 0,
        //                 "Hinduism" => 0,
        //                 "Islam" => 0,
        //                 "Judaism" => 0,
        //                 "Non-Religious" => 0,
        //                 "Other Religions" => 0
        //             ],
        //         "Albania" => [
        //                 "Buddhism" => 0,
        //                 "Christianity" => 1082066,
        //                 "Hinduism" => 0,
        //                 "Islam" => 1706456,
        //                 "Judaism" => 299,
        //                 "Non-Religious" => 72514,
        //                 "Other Religions" => 16465
        //             ],
        //             array(
        //               "Country" => "Algeria",
        //               "Buddhism" => 6578,
        //               "Christianity" => 129356,
        //               "Hinduism" => ",
        //               "Islam" => 43141684,
        //               "Judaism" => 57,
        //               "Non-Religious" => 555245,
        //               "Other Religions" => 18123
        //             ),
        //             array(
        //               "Country" => "American Samoa",
        //               "Buddhism" => 185,
        //               "Christianity" => 54091,
        //               "Hinduism" => ",
        //               "Islam" => ",
        //               "Judaism" => ",
        //               "Non-Religious" => 484,
        //               "Other Religions" => 437
        //             ),
        //             array(
        //               "Country" => "Antarctica",
        //               "Buddhism" => ",
        //               "Christianity" => ",
        //               "Hinduism" => ",
        //               "Islam" => ",
        //               "Judaism" => ",
        //               "Non-Religious" => ",
        //               "Other Religions" => "
        //             ),
        //             array(
        //               "Country" => "Aruba",
        //               "Buddhism" => 137,
        //               "Christianity" => 102776,
        //               "Hinduism" => ",
        //               "Islam" => 222,
        //               "Judaism" => 149,
        //               "Non-Religious" => 2013,
        //               "Other Religions" => 1469
        //             ),
        //             array(
        //               "Country" => "Belarus",
        //               "Buddhism" => 1134,
        //               "Christianity" => 7351480,
        //               "Hinduism" => ",
        //               "Islam" => 24894,
        //               "Judaism" => 8977,
        //               "Non-Religious" => 2062264,
        //               "Other Religions" => 572
        //             ),
        //             array(
        //               "Country" => "Benin",
        //               "Buddhism" => ",
        //               "Christianity" => 5276415,
        //               "Hinduism" => ",
        //               "Islam" => 3347253,
        //               "Judaism" => ",
        //               "Non-Religious" => 29577,
        //               "Other Religions" => 3469953
        //             ),
        //             array(
        //               "Country" => "Bermuda",
        //               "Buddhism" => 308,
        //               "Christianity" => 55244,
        //               "Hinduism" => ",
        //               "Islam" => 550,
        //               "Judaism" => 19,
        //               "Non-Religious" => 3863,
        //               "Other Religions" => 2289
        //             ),
        //             array(
        //               "Country" => "Bolivia",
        //               "Buddhism" => 8680,
        //               "Christianity" => 10836206,
        //               "Hinduism" => ",
        //               "Islam" => 2335,
        //               "Judaism" => 497,
        //               "Non-Religious" => 238465,
        //               "Other Religions" => 586846
        //             ),
        //             array(
        //               "Country" => "Bosnia and Herzegovina",
        //               "Buddhism" => ",
        //               "Christianity" => 1614414,
        //               "Hinduism" => ",
        //               "Islam" => 1561011,
        //               "Judaism" => 361,
        //               "Non-Religious" => 105029,
        //               "Other Religions" => "
        //             ),
        //             array(
        //               "Country" => "Bougainville",
        //               "Buddhism" => ",
        //               "Christianity" => ",
        //               "Hinduism" => ",
        //               "Islam" => ",
        //               "Judaism" => ",
        //               "Non-Religious" => ",
        //               "Other Religions" => "
        //             ),
        //             array(
        //               "Country" => "British Indian Ocean Territory",
        //               "Buddhism" => ",
        //               "Christianity" => ",
        //               "Hinduism" => ",
        //               "Islam" => ",
        //               "Judaism" => ",
        //               "Non-Religious" => ",
        //               "Other Religions" => "
        //             ),
        //             array(
        //               "Country" => "Bulgaria",
        //               "Buddhism" => ",
        //               "Christianity" => 5748843,
        //               "Hinduism" => ",
        //               "Islam" => 946192,
        //               "Judaism" => 3499,
        //               "Non-Religious" => 249350,
        //               "Other Religions" => 561
        //             ),
        //             array(
        //               "Country" => "Burkina Faso",
        //               "Buddhism" => ",
        //               "Christianity" => 4876074,
        //               "Hinduism" => ",
        //               "Islam" => 11398858,
        //               "Judaism" => ",
        //               "Non-Religious" => 112186,
        //               "Other Religions" => 4516160
        //             ),
        //             array(
        //               "Country" => "Cameroon",
        //               "Buddhism" => 478,
        //               "Christianity" => 15841853,
        //               "Hinduism" => ",
        //               "Islam" => 5356210,
        //               "Judaism" => 70,
        //               "Non-Religious" => 208929,
        //               "Other Religions" => 5138324
        //             ),
        //             array(
        //               "Country" => "Cape Verde",
        //               "Buddhism" => ",
        //               "Christianity" => 527733,
        //               "Hinduism" => ",
        //               "Islam" => 15623,
        //               "Judaism" => 67,
        //               "Non-Religious" => 5433,
        //               "Other Religions" => 7132
        //             ),
        //             array(
        //               "Country" => "Caribbean Netherlands",
        //               "Buddhism" => ",
        //               "Christianity" => 24162,
        //               "Hinduism" => ",
        //               "Islam" => 111,
        //               "Judaism" => 77,
        //               "Non-Religious" => 1073,
        //               "Other Religions" => 798
        //             ),
        //             array(
        //               "Country" => "Central African Republic",
        //               "Buddhism" => ",
        //               "Christianity" => 3534616,
        //               "Hinduism" => ",
        //               "Islam" => 668922,
        //               "Judaism" => ",
        //               "Non-Religious" => 33577,
        //               "Other Religions" => 592649
        //             ),
        //             array(
        //               "Country" => "Chad",
        //               "Buddhism" => 2464,
        //               "Christianity" => 5779520,
        //               "Hinduism" => ",
        //               "Islam" => 9248806,
        //               "Judaism" => ",
        //               "Non-Religious" => 18048,
        //               "Other Religions" => 1377021
        //             ),
        //             array(
        //               "Country" => "China-Tibet",
        //               "Buddhism" => ",
        //               "Christianity" => ",
        //               "Hinduism" => ",
        //               "Islam" => ",
        //               "Judaism" => ",
        //               "Non-Religious" => ",
        //               "Other Religions" => "
        //             ),
        //             array(
        //               "Country" => "Christmas Island",
        //               "Buddhism" => ",
        //               "Christianity" => ",
        //               "Hinduism" => ",
        //               "Islam" => ",
        //               "Judaism" => ",
        //               "Non-Religious" => ",
        //               "Other Religions" => "
        //             ),
        //             array(
        //               "Country" => "Cocos (Keeling) Islands",
        //               "Buddhism" => ",
        //               "Christianity" => ",
        //               "Hinduism" => ",
        //               "Islam" => ",
        //               "Judaism" => ",
        //               "Non-Religious" => ",
        //               "Other Religions" => "
        //             ),
        //             array(
        //               "Country" => "Comoros",
        //               "Buddhism" => ",
        //               "Christianity" => 4444,
        //               "Hinduism" => ",
        //               "Islam" => 854824,
        //               "Judaism" => ",
        //               "Non-Religious" => 1150,
        //               "Other Religions" => 9177
        //             ),
        //             array(
        //               "Country" => "Congo, Republic of the",
        //               "Buddhism" => 237,
        //               "Christianity" => 4928953,
        //               "Hinduism" => ",
        //               "Islam" => 68633,
        //               "Judaism" => ",
        //               "Non-Religious" => 163654,
        //               "Other Religions" => 356615
        //             ),
        //             array(
        //               "Country" => "Cook Islands",
        //               "Buddhism" => ",
        //               "Christianity" => 16939,
        //               "Hinduism" => ",
        //               "Islam" => ",
        //               "Judaism" => ",
        //               "Non-Religious" => 468,
        //               "Other Religions" => 157
        //             ),
        //             array(
        //               "Country" => "Croatia",
        //               "Buddhism" => ",
        //               "Christianity" => 3849511,
        //               "Hinduism" => ",
        //               "Islam" => 77420,
        //               "Judaism" => 813,
        //               "Non-Religious" => 177524,
        //               "Other Religions" => "
        //             ),
        //             array(
        //               "Country" => "Dhekelia",
        //               "Buddhism" => ",
        //               "Christianity" => ",
        //               "Hinduism" => ",
        //               "Islam" => ",
        //               "Judaism" => ",
        //               "Non-Religious" => ",
        //               "Other Religions" => "
        //             ),
        //             array(
        //               "Country" => "Dominican Republic",
        //               "Buddhism" => 1953,
        //               "Christianity" => 10296182,
        //               "Hinduism" => ",
        //               "Islam" => 2387,
        //               "Judaism" => 103,
        //               "Non-Religious" => 290744,
        //               "Other Religions" => 256535
        //             ),
        //             array(
        //               "Country" => "Ecuador",
        //               "Buddhism" => 18551,
        //               "Christianity" => 16842563,
        //               "Hinduism" => ",
        //               "Islam" => 2399,
        //               "Judaism" => 492,
        //               "Non-Religious" => 594883,
        //               "Other Religions" => 184172
        //             ),
        //             array(
        //               "Country" => "El Salvador",
        //               "Buddhism" => 623,
        //               "Christianity" => 6270984,
        //               "Hinduism" => ",
        //               "Islam" => 1822,
        //               "Judaism" => 584,
        //               "Non-Religious" => 166791,
        //               "Other Religions" => 45397
        //             ),
        //             array(
        //               "Country" => "Falkland Islands (Islas Malvinas)",
        //               "Buddhism" => 7,
        //               "Christianity" => 2882,
        //               "Hinduism" => ",
        //               "Islam" => ",
        //               "Judaism" => ",
        //               "Non-Religious" => 421,
        //               "Other Religions" => 173
        //             ),
        //             array(
        //               "Country" => "Faroe Islands",
        //               "Buddhism" => ",
        //               "Christianity" => 47908,
        //               "Hinduism" => ",
        //               "Islam" => ",
        //               "Judaism" => ",
        //               "Non-Religious" => 815,
        //               "Other Religions" => 142
        //             ),
        //             array(
        //               "Country" => "French Polynesia",
        //               "Buddhism" => 264,
        //               "Christianity" => 263515,
        //               "Hinduism" => ",
        //               "Islam" => ",
        //               "Judaism" => 152,
        //               "Non-Religious" => 14200,
        //               "Other Religions" => 2773
        //             ),
        //             array(
        //               "Country" => "Gabon",
        //               "Buddhism" => ",
        //               "Christianity" => 1885676,
        //               "Hinduism" => ",
        //               "Islam" => 224505,
        //               "Judaism" => ",
        //               "Non-Religious" => 27819,
        //               "Other Religions" => 87728
        //             ),
        //             array(
        //               "Country" => "Georgia",
        //               "Buddhism" => ",
        //               "Christianity" => 3424267,
        //               "Hinduism" => ",
        //               "Islam" => 439267,
        //               "Judaism" => 4055,
        //               "Non-Religious" => 119612,
        //               "Other Religions" => 1974
        //             ),
        //             array(
        //               "Country" => "Greenland",
        //               "Buddhism" => ",
        //               "Christianity" => 54447,
        //               "Hinduism" => ",
        //               "Islam" => 10,
        //               "Judaism" => ",
        //               "Non-Religious" => 1507,
        //               "Other Religions" => 808
        //             ),
        //             array(
        //               "Country" => "Guam",
        //               "Buddhism" => 1773,
        //               "Christianity" => 158684,
        //               "Hinduism" => ",
        //               "Islam" => 51,
        //               "Judaism" => ",
        //               "Non-Religious" => 3094,
        //               "Other Religions" => 5181
        //             ),
        //             array(
        //               "Country" => "Guatemala",
        //               "Buddhism" => 3117,
        //               "Christianity" => 17441282,
        //               "Hinduism" => ",
        //               "Islam" => 1433,
        //               "Judaism" => 1206,
        //               "Non-Religious" => 244802,
        //               "Other Religions" => 223726
        //             ),
        //             array(
        //               "Country" => "Guernsey",
        //               "Buddhism" => ",
        //               "Christianity" => ",
        //               "Hinduism" => ",
        //               "Islam" => ",
        //               "Judaism" => ",
        //               "Non-Religious" => ",
        //               "Other Religions" => "
        //             ),
        //             array(
        //               "Country" => "Guinea",
        //               "Buddhism" => 11820,
        //               "Christianity" => 462663,
        //               "Hinduism" => ",
        //               "Islam" => 11399127,
        //               "Judaism" => ",
        //               "Non-Religious" => 21497,
        //               "Other Religions" => 1237685
        //             ),
        //             array(
        //               "Country" => "Guinea-Bissau",
        //               "Buddhism" => ",
        //               "Christianity" => 255244,
        //               "Hinduism" => ",
        //               "Islam" => 878765,
        //               "Judaism" => ",
        //               "Non-Religious" => 23419,
        //               "Other Religions" => 810570
        //             ),
        //             array(
        //               "Country" => "Haiti",
        //               "Buddhism" => ",
        //               "Christianity" => 10747565,
        //               "Hinduism" => ",
        //               "Islam" => 2691,
        //               "Judaism" => 239,
        //               "Non-Religious" => 313143,
        //               "Other Religions" => 338895
        //             ),
        //             array(
        //               "Country" => "Honduras",
        //               "Buddhism" => 5586,
        //               "Christianity" => 9485050,
        //               "Hinduism" => ",
        //               "Islam" => 14508,
        //               "Judaism" => 401,
        //               "Non-Religious" => 202493,
        //               "Other Religions" => 196570
        //             ),
        //             array(
        //               "Country" => "Hungary",
        //               "Buddhism" => 4135,
        //               "Christianity" => 8429446,
        //               "Hinduism" => ",
        //               "Islam" => 30517,
        //               "Judaism" => 46283,
        //               "Non-Religious" => 1144877,
        //               "Other Religions" => 5092
        //             ),
        //             array(
        //               "Country" => "Jersey",
        //               "Buddhism" => ",
        //               "Christianity" => ",
        //               "Hinduism" => ",
        //               "Islam" => ",
        //               "Judaism" => ",
        //               "Non-Religious" => ",
        //               "Other Religions" => "
        //             ),
        //             array(
        //               "Country" => "Jordan",
        //               "Buddhism" => ",
        //               "Christianity" => 140973,
        //               "Hinduism" => ",
        //               "Islam" => 9728323,
        //               "Judaism" => ",
        //               "Non-Religious" => 302616,
        //               "Other Religions" => 31228
        //             ),
        //             array(
        //               "Country" => "Kiribati",
        //               "Buddhism" => 16,
        //               "Christianity" => 115637,
        //               "Hinduism" => ",
        //               "Islam" => ",
        //               "Judaism" => ",
        //               "Non-Religious" => 843,
        //               "Other Religions" => 2950
        //             ),
        //             array(
        //               "Country" => "Korea, (North) Democratic Republic of",
        //               "Buddhism" => 391038,
        //               "Christianity" => 99001,
        //               "Hinduism" => ",
        //               "Islam" => 2578,
        //               "Judaism" => ",
        //               "Non-Religious" => 18784687,
        //               "Other Religions" => 6501511
        //             ),
        //             array(
        //               "Country" => "Kosovo",
        //               "Buddhism" => ",
        //               "Christianity" => 129021,
        //               "Hinduism" => ",
        //               "Islam" => 1948262,
        //               "Judaism" => ",
        //               "Non-Religious" => 18817,
        //               "Other Religions" => "
        //             ),
        //             array(
        //               "Country" => "Kyrgyzstan",
        //               "Buddhism" => 32034,
        //               "Christianity" => 286253,
        //               "Hinduism" => ",
        //               "Islam" => 5687649,
        //               "Judaism" => 398,
        //               "Non-Religious" => 482755,
        //               "Other Religions" => 35100
        //             ),
        //             array(
        //               "Country" => "Liberia",
        //               "Buddhism" => ",
        //               "Christianity" => 2085024,
        //               "Hinduism" => ",
        //               "Islam" => 807836,
        //               "Judaism" => ",
        //               "Non-Religious" => 80260,
        //               "Other Religions" => 2084557
        //             ),
        //             array(
        //               "Country" => "Liechtenstein",
        //               "Buddhism" => ",
        //               "Christianity" => 33852,
        //               "Hinduism" => ",
        //               "Islam" => 2393,
        //               "Judaism" => 50,
        //               "Non-Religious" => 1830,
        //               "Other Religions" => 12
        //             ),
        //             array(
        //               "Country" => "Luxembourg",
        //               "Buddhism" => ",
        //               "Christianity" => 474235,
        //               "Hinduism" => ",
        //               "Islam" => 15712,
        //               "Judaism" => 800,
        //               "Non-Religious" => 133267,
        //               "Other Religions" => 1962
        //             ),
        //             array(
        //               "Country" => "Macau",
        //               "Buddhism" => 112157,
        //               "Christianity" => 45606,
        //               "Hinduism" => ",
        //               "Islam" => 1299,
        //               "Judaism" => 29,
        //               "Non-Religious" => 102825,
        //               "Other Religions" => 387426
        //             ),
        //             array(
        //               "Country" => "Macedonia",
        //               "Buddhism" => ",
        //               "Christianity" => 1332438,
        //               "Hinduism" => ",
        //               "Islam" => 682224,
        //               "Judaism" => 198,
        //               "Non-Religious" => 68520,
        //               "Other Religions" => "
        //             ),
        //             array(
        //               "Country" => "Mali",
        //               "Buddhism" => ",
        //               "Christianity" => 475145,
        //               "Hinduism" => ",
        //               "Islam" => 17835541,
        //               "Judaism" => ",
        //               "Non-Religious" => 25455,
        //               "Other Religions" => 1914692
        //             ),
        //             array(
        //               "Country" => "Marshall Islands",
        //               "Buddhism" => ",
        //               "Christianity" => 56263,
        //               "Hinduism" => ",
        //               "Islam" => 210,
        //               "Judaism" => ",
        //               "Non-Religious" => 887,
        //               "Other Religions" => 1834
        //             ),
        //             array(
        //               "Country" => "Mauritania",
        //               "Buddhism" => ",
        //               "Christianity" => 10870,
        //               "Hinduism" => ",
        //               "Islam" => 4611784,
        //               "Judaism" => ",
        //               "Non-Religious" => 4952,
        //               "Other Religions" => 22054
        //             ),
        //             array(
        //               "Country" => "Mayotte",
        //               "Buddhism" => ",
        //               "Christianity" => 1423,
        //               "Hinduism" => ",
        //               "Islam" => 269645,
        //               "Judaism" => ",
        //               "Non-Religious" => 490,
        //               "Other Religions" => 1255
        //             ),
        //             array(
        //               "Country" => "Micronesia, Federated States of",
        //               "Buddhism" => 489,
        //               "Christianity" => 108913,
        //               "Hinduism" => ",
        //               "Islam" => ",
        //               "Judaism" => ",
        //               "Non-Religious" => 1017,
        //               "Other Religions" => 4602
        //             ),
        //             array(
        //               "Country" => "Moldova",
        //               "Buddhism" => ",
        //               "Christianity" => 3920300,
        //               "Hinduism" => ",
        //               "Islam" => 18491,
        //               "Judaism" => 3677,
        //               "Non-Religious" => 90646,
        //               "Other Religions" => 849
        //             ),
        //             array(
        //               "Country" => "Monaco",
        //               "Buddhism" => ",
        //               "Christianity" => 33489,
        //               "Hinduism" => ",
        //               "Islam" => 177,
        //               "Judaism" => 600,
        //               "Non-Religious" => 4903,
        //               "Other Religions" => 75
        //             ),
        //             array(
        //               "Country" => "Mongolia",
        //               "Buddhism" => 1905634,
        //               "Christianity" => 63575,
        //               "Hinduism" => ",
        //               "Islam" => 163378,
        //               "Judaism" => ",
        //               "Non-Religious" => 525509,
        //               "Other Religions" => 620197
        //             ),
        //             array(
        //               "Country" => "Montenegro",
        //               "Buddhism" => ",
        //               "Christianity" => 497511,
        //               "Hinduism" => ",
        //               "Islam" => 108321,
        //               "Judaism" => ",
        //               "Non-Religious" => 22230,
        //               "Other Religions" => "
        //             ),
        //             array(
        //               "Country" => "Morocco",
        //               "Buddhism" => ",
        //               "Christianity" => 31550,
        //               "Hinduism" => ",
        //               "Islam" => 36790789,
        //               "Judaism" => 2281,
        //               "Non-Religious" => 48275,
        //               "Other Religions" => 37662
        //             ),
        //             array(
        //               "Country" => "Namibia",
        //               "Buddhism" => ",
        //               "Christianity" => 2309459,
        //               "Hinduism" => ",
        //               "Islam" => 8741,
        //               "Judaism" => 100,
        //               "Non-Religious" => 58165,
        //               "Other Religions" => 164451
        //             ),
        //             array(
        //               "Country" => "Nauru",
        //               "Buddhism" => 149,
        //               "Christianity" => 8128,
        //               "Hinduism" => ",
        //               "Islam" => ",
        //               "Judaism" => ",
        //               "Non-Religious" => 454,
        //               "Other Religions" => 2103
        //             ),
        //             array(
        //               "Country" => "New Caledonia",
        //               "Buddhism" => 1784,
        //               "Christianity" => 242961,
        //               "Hinduism" => ",
        //               "Islam" => 7880,
        //               "Judaism" => 100,
        //               "Non-Religious" => 30045,
        //               "Other Religions" => 2721
        //             ),
        //             array(
        //               "Country" => "Nicaragua",
        //               "Buddhism" => 7618,
        //               "Christianity" => 6296831,
        //               "Hinduism" => ",
        //               "Islam" => 1126,
        //               "Judaism" => 221,
        //               "Non-Religious" => 173059,
        //               "Other Religions" => 145699
        //             ),
        //             array(
        //               "Country" => "Niger",
        //               "Buddhism" => ",
        //               "Christianity" => 62896,
        //               "Hinduism" => ",
        //               "Islam" => 23120345,
        //               "Judaism" => ",
        //               "Non-Religious" => 14026,
        //               "Other Religions" => 1009369
        //             ),
        //             array(
        //               "Country" => "Niue",
        //               "Buddhism" => ",
        //               "Christianity" => 1565,
        //               "Hinduism" => ",
        //               "Islam" => ",
        //               "Judaism" => ",
        //               "Non-Religious" => 41,
        //               "Other Religions" => 12
        //             ),
        //             array(
        //               "Country" => "Norfolk Island",
        //               "Buddhism" => ",
        //               "Christianity" => ",
        //               "Hinduism" => ",
        //               "Islam" => ",
        //               "Judaism" => ",
        //               "Non-Religious" => ",
        //               "Other Religions" => "
        //             ),
        //             array(
        //               "Country" => "Northern Cyprus",
        //               "Buddhism" => ",
        //               "Christianity" => ",
        //               "Hinduism" => ",
        //               "Islam" => ",
        //               "Judaism" => ",
        //               "Non-Religious" => ",
        //               "Other Religions" => "
        //             ),
        //             array(
        //               "Country" => "Northern Mariana Islands",
        //               "Buddhism" => 6081,
        //               "Christianity" => 46737,
        //               "Hinduism" => ",
        //               "Islam" => 391,
        //               "Judaism" => ",
        //               "Non-Religious" => 633,
        //               "Other Religions" => 3715
        //             ),
        //             array(
        //               "Country" => "Occupied Palestinian Territories",
        //               "Buddhism" => ",
        //               "Christianity" => 45078,
        //               "Hinduism" => ",
        //               "Islam" => 4118141,
        //               "Judaism" => 666765,
        //               "Non-Religious" => 268859,
        //               "Other Religions" => 2573
        //             ),
        //             array(
        //               "Country" => "Paraguay",
        //               "Buddhism" => 16367,
        //               "Christianity" => 6810364,
        //               "Hinduism" => ",
        //               "Islam" => 4280,
        //               "Judaism" => 1000,
        //               "Non-Religious" => 141162,
        //               "Other Religions" => 159357
        //             ),
        //             array(
        //               "Country" => "Peru",
        //               "Buddhism" => 74177,
        //               "Christianity" => 31808544,
        //               "Hinduism" => ",
        //               "Islam" => 831,
        //               "Judaism" => 4999,
        //               "Non-Religious" => 455201,
        //               "Other Religions" => 628094
        //             ),
        //             array(
        //               "Country" => "Pitcairn Islands",
        //               "Buddhism" => ",
        //               "Christianity" => ",
        //               "Hinduism" => ",
        //               "Islam" => ",
        //               "Judaism" => ",
        //               "Non-Religious" => ",
        //               "Other Religions" => "
        //             ),
        //             array(
        //               "Country" => "Romania",
        //               "Buddhism" => 423,
        //               "Christianity" => 18958980,
        //               "Hinduism" => ",
        //               "Islam" => 80661,
        //               "Judaism" => 4000,
        //               "Non-Religious" => 187682,
        //               "Other Religions" => 5936
        //             ),
        //             array(
        //               "Country" => "Saint Barthelemy",
        //               "Buddhism" => ",
        //               "Christianity" => ",
        //               "Hinduism" => ",
        //               "Islam" => ",
        //               "Judaism" => ",
        //               "Non-Religious" => ",
        //               "Other Religions" => "
        //             ),
        //             array(
        //               "Country" => "Saint Helena",
        //               "Buddhism" => ",
        //               "Christianity" => 5817,
        //               "Hinduism" => ",
        //               "Islam" => ",
        //               "Judaism" => ",
        //               "Non-Religious" => 206,
        //               "Other Religions" => 48
        //             ),
        //             array(
        //               "Country" => "Saint Martin",
        //               "Buddhism" => ",
        //               "Christianity" => ",
        //               "Hinduism" => ",
        //               "Islam" => ",
        //               "Judaism" => ",
        //               "Non-Religious" => ",
        //               "Other Religions" => "
        //             ),
        //             array(
        //               "Country" => "Saint Pierre and Miquelon",
        //               "Buddhism" => ",
        //               "Christianity" => 5472,
        //               "Hinduism" => ",
        //               "Islam" => 9,
        //               "Judaism" => ",
        //               "Non-Religious" => 226,
        //               "Other Religions" => 88
        //             ),
        //             array(
        //               "Country" => "Samoa",
        //               "Buddhism" => 20,
        //               "Christianity" => 196012,
        //               "Hinduism" => ",
        //               "Islam" => 63,
        //               "Judaism" => ",
        //               "Non-Religious" => 1243,
        //               "Other Religions" => 1072
        //             ),
        //             array(
        //               "Country" => "San Marino",
        //               "Buddhism" => ",
        //               "Christianity" => 31056,
        //               "Hinduism" => ",
        //               "Islam" => 10,
        //               "Judaism" => ",
        //               "Non-Religious" => 2564,
        //               "Other Religions" => 309
        //             ),
        //             array(
        //               "Country" => "Sao Tome and Principe",
        //               "Buddhism" => ",
        //               "Christianity" => 210608,
        //               "Hinduism" => ",
        //               "Islam" => 88,
        //               "Judaism" => ",
        //               "Non-Religious" => 2911,
        //               "Other Religions" => 5554
        //             ),
        //             array(
        //               "Country" => "Senegal",
        //               "Buddhism" => 2260,
        //               "Christianity" => 860785,
        //               "Hinduism" => ",
        //               "Islam" => 15228387,
        //               "Judaism" => ",
        //               "Non-Religious" => 28134,
        //               "Other Religions" => 624364
        //             ),
        //             array(
        //               "Country" => "Serbia",
        //               "Buddhism" => ",
        //               "Christianity" => 5940421,
        //               "Hinduism" => ",
        //               "Islam" => 463296,
        //               "Judaism" => 2963,
        //               "Non-Religious" => 230586,
        //               "Other Religions" => 4004
        //             ),
        //             array(
        //               "Country" => "Sint Maarten",
        //               "Buddhism" => ",
        //               "Christianity" => 38297,
        //               "Hinduism" => ",
        //               "Islam" => 77,
        //               "Judaism" => 130,
        //               "Non-Religious" => 1304,
        //               "Other Religions" => 3074
        //             ),
        //             array(
        //               "Country" => "Slovakia",
        //               "Buddhism" => ",
        //               "Christianity" => 4616435,
        //               "Hinduism" => ",
        //               "Islam" => 524,
        //               "Judaism" => 2506,
        //               "Non-Religious" => 839025,
        //               "Other Religions" => 1153
        //             ),
        //             array(
        //               "Country" => "Slovenia",
        //               "Buddhism" => ",
        //               "Christianity" => 1732110,
        //               "Hinduism" => ",
        //               "Islam" => 79041,
        //               "Judaism" => 208,
        //               "Non-Religious" => 266962,
        //               "Other Religions" => 611
        //             ),
        //             array(
        //               "Country" => "Solomon Islands",
        //               "Buddhism" => 2176,
        //               "Christianity" => 654437,
        //               "Hinduism" => ",
        //               "Islam" => 2167,
        //               "Judaism" => ",
        //               "Non-Religious" => 2046,
        //               "Other Religions" => 26052
        //             ),
        //             array(
        //               "Country" => "Somaliland",
        //               "Buddhism" => ",
        //               "Christianity" => ",
        //               "Hinduism" => ",
        //               "Islam" => ",
        //               "Judaism" => ",
        //               "Non-Religious" => ",
        //               "Other Religions" => "
        //             ),
        //             array(
        //               "Country" => "Spanish North Africa",
        //               "Buddhism" => ",
        //               "Christianity" => ",
        //               "Hinduism" => ",
        //               "Islam" => ",
        //               "Judaism" => ",
        //               "Non-Religious" => ",
        //               "Other Religions" => "
        //             ),
        //             array(
        //               "Country" => "Svalbard",
        //               "Buddhism" => ",
        //               "Christianity" => ",
        //               "Hinduism" => ",
        //               "Islam" => ",
        //               "Judaism" => ",
        //               "Non-Religious" => ",
        //               "Other Religions" => "
        //             ),
        //             array(
        //               "Country" => "Tajikistan",
        //               "Buddhism" => 3822,
        //               "Christianity" => 65886,
        //               "Hinduism" => ",
        //               "Islam" => 9294837,
        //               "Judaism" => 305,
        //               "Non-Religious" => 159738,
        //               "Other Religions" => 13054
        //             ),
        //             array(
        //               "Country" => "Togo",
        //               "Buddhism" => ",
        //               "Christianity" => 3960702,
        //               "Hinduism" => ",
        //               "Islam" => 1519640,
        //               "Judaism" => ",
        //               "Non-Religious" => 19200,
        //               "Other Religions" => 2779195
        //             ),
        //             array(
        //               "Country" => "Tokelau",
        //               "Buddhism" => ",
        //               "Christianity" => 1273,
        //               "Hinduism" => ",
        //               "Islam" => ",
        //               "Judaism" => ",
        //               "Non-Religious" => 13,
        //               "Other Religions" => 64
        //             ),
        //             array(
        //               "Country" => "Tunisia",
        //               "Buddhism" => 89,
        //               "Christianity" => 23090,
        //               "Hinduism" => ",
        //               "Islam" => 11759347,
        //               "Judaism" => 1989,
        //               "Non-Religious" => 31550,
        //               "Other Religions" => 2553
        //             ),
        //             array(
        //               "Country" => "Turkmenistan",
        //               "Buddhism" => 852,
        //               "Christianity" => 68049,
        //               "Hinduism" => ",
        //               "Islam" => 5779977,
        //               "Judaism" => 499,
        //               "Non-Religious" => 178754,
        //               "Other Religions" => 3056
        //             ),
        //             array(
        //               "Country" => "Turks and Caicos Islands",
        //               "Buddhism" => ",
        //               "Christianity" => 35421,
        //               "Hinduism" => ",
        //               "Islam" => ",
        //               "Judaism" => ",
        //               "Non-Religious" => 2103,
        //               "Other Religions" => 1194
        //             ),
        //             array(
        //               "Country" => "Tuvalu",
        //               "Buddhism" => 14,
        //               "Christianity" => 11173,
        //               "Hinduism" => ",
        //               "Islam" => 12,
        //               "Judaism" => ",
        //               "Non-Religious" => 391,
        //               "Other Religions" => 202
        //             ),
        //             array(
        //               "Country" => "Uruguay",
        //               "Buddhism" => 67,
        //               "Christianity" => 2208996,
        //               "Hinduism" => ",
        //               "Islam" => 521,
        //               "Judaism" => 20255,
        //               "Non-Religious" => 1229278,
        //               "Other Religions" => 14610
        //             ),
        //             array(
        //               "Country" => "Vanuatu",
        //               "Buddhism" => 603,
        //               "Christianity" => 286852,
        //               "Hinduism" => ",
        //               "Islam" => 127,
        //               "Judaism" => ",
        //               "Non-Religious" => 1258,
        //               "Other Religions" => 18310
        //             ),
        //             array(
        //               "Country" => "Vatican City",
        //               "Buddhism" => ",
        //               "Christianity" => 809,
        //               "Hinduism" => ",
        //               "Islam" => ",
        //               "Judaism" => ",
        //               "Non-Religious" => ",
        //               "Other Religions" => "
        //             ),
        //             array(
        //               "Country" => "Wallis and Futuna",
        //               "Buddhism" => ",
        //               "Christianity" => 10944,
        //               "Hinduism" => ",
        //               "Islam" => ",
        //               "Judaism" => ",
        //               "Non-Religious" => 73,
        //               "Other Religions" => 229
        //             ),
        //             array(
        //               "Country" => "Western Sahara",
        //               "Buddhism" => ",
        //               "Christianity" => 921,
        //               "Hinduism" => ",
        //               "Islam" => 594653,
        //               "Judaism" => ",
        //               "Non-Religious" => 1511,
        //               "Other Religions" => 245
        //             ),
        //             array(
        //               "Country" => "Angola",
        //               "Buddhism" => 2810,
        //               "Christianity" => 30517271,
        //               "Hinduism" => 657,
        //               "Islam" => 366337,
        //               "Judaism" => ",
        //               "Non-Religious" => 301292,
        //               "Other Religions" => 1677901
        //             ),
        //             array(
        //               "Country" => "Azerbaijan",
        //               "Buddhism" => ",
        //               "Christianity" => 245870,
        //               "Hinduism" => 304,
        //               "Islam" => 9748557,
        //               "Judaism" => 8833,
        //               "Non-Religious" => 132055,
        //               "Other Religions" => 3556
        //             ),
        //             array(
        //               "Country" => "Chile",
        //               "Buddhism" => 12118,
        //               "Christianity" => 16869213,
        //               "Hinduism" => 930,
        //               "Islam" => 18166,
        //               "Judaism" => 20129,
        //               "Non-Religious" => 2009793,
        //               "Other Religions" => 185860
        //             ),
        //             array(
        //               "Country" => "China",
        //               "Buddhism" => 228116515,
        //               "Christianity" => 106018155,
        //               "Hinduism" => 19388,
        //               "Islam" => 23746340,
        //               "Judaism" => 2879,
        //               "Non-Religious" => 574478084,
        //               "Other Religions" => 506942413
        //             ),
        //             array(
        //               "Country" => "Egypt",
        //               "Buddhism" => 998,
        //               "Christianity" => 9473480,
        //               "Hinduism" => 1535,
        //               "Islam" => 92165041,
        //               "Judaism" => 101,
        //               "Non-Religious" => 688643,
        //               "Other Religions" => 4603
        //             ),
        //             array(
        //               "Country" => "Korea, (South) Republic of",
        //               "Buddhism" => 12637443,
        //               "Christianity" => 17012623,
        //               "Hinduism" => 2307,
        //               "Islam" => 70927,
        //               "Judaism" => 108,
        //               "Non-Religious" => 817805,
        //               "Other Religions" => 20727970
        //             ),
        //             array(
        //               "Country" => "Poland",
        //               "Buddhism" => 1968,
        //               "Christianity" => 36183532,
        //               "Hinduism" => 1079,
        //               "Islam" => 38638,
        //               "Judaism" => 3075,
        //               "Non-Religious" => 1603138,
        //               "Other Religions" => 15175
        //             ),
        //             array(
        //               "Country" => "South Sudan",
        //               "Buddhism" => 254,
        //               "Christianity" => 6772390,
        //               "Hinduism" => 224,
        //               "Islam" => 696586,
        //               "Judaism" => ",
        //               "Non-Religious" => 49286,
        //               "Other Religions" => 3674989
        //             ),
        //             array(
        //               "Country" => "Sudan",
        //               "Buddhism" => 987,
        //               "Christianity" => 1974012,
        //               "Hinduism" => 864,
        //               "Islam" => 40197223,
        //               "Judaism" => 57,
        //               "Non-Religious" => 459449,
        //               "Other Religions" => 1216677
        //             ),
        //             array(
        //               "Country" => "Turkey",
        //               "Buddhism" => 41056,
        //               "Christianity" => 176131,
        //               "Hinduism" => 843,
        //               "Islam" => 82995694,
        //               "Judaism" => 15763,
        //               "Non-Religious" => 915333,
        //               "Other Religions" => 194247
        //             ),
        //             array(
        //               "Country" => "Uzbekistan",
        //               "Buddhism" => 36779,
        //               "Christianity" => 347705,
        //               "Hinduism" => 895,
        //               "Islam" => 31721531,
        //               "Judaism" => 4085,
        //               "Non-Religious" => 1302315,
        //               "Other Religions" => 55889
        //             ),
        //             array(
        //               "Country" => "Venezuela",
        //               "Buddhism" => 34749,
        //               "Christianity" => 26343153,
        //               "Hinduism" => 569,
        //               "Islam" => 93554,
        //               "Judaism" => 7516,
        //               "Non-Religious" => 1268623,
        //               "Other Religions" => 687779
        //             ),
        //             array(
        //               "Country" => "Argentina",
        //               "Buddhism" => 24191,
        //               "Christianity" => 40118101,
        //               "Hinduism" => 6639,
        //               "Islam" => 968094,
        //               "Judaism" => 179992,
        //               "Non-Religious" => 3551567,
        //               "Other Religions" => 347193
        //             ),
        //             array(
        //               "Country" => "Armenia",
        //               "Buddhism" => 296,
        //               "Christianity" => 2806648,
        //               "Hinduism" => 296,
        //               "Islam" => 6393,
        //               "Judaism" => 517,
        //               "Non-Religious" => 105717,
        //               "Other Religions" => 43367
        //             ),
        //             array(
        //               "Country" => "Brazil",
        //               "Buddhism" => 541513,
        //               "Christianity" => 192938521,
        //               "Hinduism" => 10628,
        //               "Islam" => 211300,
        //               "Judaism" => 96077,
        //               "Non-Religious" => 6436639,
        //               "Other Religions" => 12324731
        //             ),
        //             array(
        //               "Country" => "Costa Rica",
        //               "Buddhism" => 1337,
        //               "Christianity" => 4859643,
        //               "Hinduism" => 611,
        //               "Islam" => ",
        //               "Judaism" => 2888,
        //               "Non-Religious" => 174053,
        //               "Other Religions" => 55582
        //             ),
        //             array(
        //               "Country" => "Cote d"Ivoire",
        //               "Buddhism" => 13189,
        //               "Christianity" => 9202347,
        //               "Hinduism" => 1899,
        //               "Islam" => 10878330,
        //               "Judaism" => ",
        //               "Non-Religious" => 96727,
        //               "Other Religions" => 6185783
        //             ),
        //             array(
        //               "Country" => "Czech Republic",
        //               "Buddhism" => 50868,
        //               "Christianity" => 3746299,
        //               "Hinduism" => 535,
        //               "Islam" => 13675,
        //               "Judaism" => 3791,
        //               "Non-Religious" => 6883247,
        //               "Other Religions" => 10567
        //             ),
        //             array(
        //               "Country" => "Ethiopia",
        //               "Buddhism" => 1839,
        //               "Christianity" => 67902667,
        //               "Hinduism" => 8562,
        //               "Islam" => 39524539,
        //               "Judaism" => 17245,
        //               "Non-Religious" => 112302,
        //               "Other Religions" => 7396429
        //             ),
        //             array(
        //               "Country" => "Iraq",
        //               "Buddhism" => 362,
        //               "Christianity" => 185558,
        //               "Hinduism" => 4827,
        //               "Islam" => 39179468,
        //               "Judaism" => 20,
        //               "Non-Religious" => 265897,
        //               "Other Religions" => 586371
        //             ),
        //             array(
        //               "Country" => "Israel",
        //               "Buddhism" => 40681,
        //               "Christianity" => 187778,
        //               "Hinduism" => 433,
        //               "Islam" => 1746624,
        //               "Judaism" => 6214655,
        //               "Non-Religious" => 439056,
        //               "Other Religions" => 26314
        //             ),
        //             array(
        //               "Country" => "Kazakhstan",
        //               "Buddhism" => 21593,
        //               "Christianity" => 4890586,
        //               "Hinduism" => 939,
        //               "Islam" => 12926705,
        //               "Judaism" => 5481,
        //               "Non-Religious" => 878309,
        //               "Other Religions" => 53092
        //             ),
        //             array(
        //               "Country" => "Malta",
        //               "Buddhism" => ",
        //               "Christianity" => 423850,
        //               "Hinduism" => 46,
        //               "Islam" => 8938,
        //               "Judaism" => 61,
        //               "Non-Religious" => 8359,
        //               "Other Religions" => 285
        //             ),
        //             array(
        //               "Country" => "Mexico",
        //               "Buddhism" => 29912,
        //               "Christianity" => 123370089,
        //               "Hinduism" => 11704,
        //               "Islam" => 120781,
        //               "Judaism" => 39979,
        //               "Non-Religious" => 3908868,
        //               "Other Religions" => 1451420
        //             ),
        //             array(
        //               "Country" => "Papua New Guinea",
        //               "Buddhism" => 14654,
        //               "Christianity" => 8482207,
        //               "Hinduism" => 1188,
        //               "Islam" => 2376,
        //               "Judaism" => 800,
        //               "Non-Religious" => 61442,
        //               "Other Religions" => 384360
        //             ),
        //             array(
        //               "Country" => "Rwanda",
        //               "Buddhism" => ",
        //               "Christianity" => 11852297,
        //               "Hinduism" => 648,
        //               "Islam" => 619532,
        //               "Judaism" => ",
        //               "Non-Religious" => 26129,
        //               "Other Religions" => 453603
        //             ),
        //             array(
        //               "Country" => "Syria",
        //               "Buddhism" => ",
        //               "Christianity" => 672156,
        //               "Hinduism" => 1750,
        //               "Islam" => 16479667,
        //               "Judaism" => 98,
        //               "Non-Religious" => 346521,
        //               "Other Religions" => 465
        //             ),
        //             array(
        //               "Country" => "Taiwan",
        //               "Buddhism" => 6304063,
        //               "Christianity" => 1441852,
        //               "Hinduism" => 2382,
        //               "Islam" => 92311,
        //               "Judaism" => 192,
        //               "Non-Religious" => 1061750,
        //               "Other Religions" => 14914225
        //             ),
        //             array(
        //               "Country" => "Ukraine",
        //               "Buddhism" => 17772,
        //               "Christianity" => 37004929,
        //               "Hinduism" => 4592,
        //               "Islam" => 716078,
        //               "Judaism" => 45404,
        //               "Non-Religious" => 5926508,
        //               "Other Religions" => 18476
        //             ),
        //             array(
        //               "Country" => "Colombia",
        //               "Buddhism" => 2028,
        //               "Christianity" => 48543031,
        //               "Hinduism" => 12264,
        //               "Islam" => 25085,
        //               "Judaism" => 5037,
        //               "Non-Religious" => 1380466,
        //               "Other Religions" => 914973
        //             ),
        //             array(
        //               "Country" => "Finland",
        //               "Buddhism" => 5153,
        //               "Christianity" => 4353908,
        //               "Hinduism" => 831,
        //               "Islam" => 114361,
        //               "Judaism" => 1309,
        //               "Non-Religious" => 1056535,
        //               "Other Religions" => 8621
        //             ),
        //             array(
        //               "Country" => "Gambia, The",
        //               "Buddhism" => ",
        //               "Christianity" => 110667,
        //               "Hinduism" => 391,
        //               "Islam" => 2140858,
        //               "Judaism" => ",
        //               "Non-Religious" => 13820,
        //               "Other Religions" => 150928
        //             ),
        //             array(
        //               "Country" => "Ghana",
        //               "Buddhism" => 621,
        //               "Christianity" => 22097094,
        //               "Hinduism" => 6215,
        //               "Islam" => 5588340,
        //               "Judaism" => 392,
        //               "Non-Religious" => 97989,
        //               "Other Religions" => 3282294
        //             ),
        //             array(
        //               "Country" => "Japan",
        //               "Buddhism" => 70538721,
        //               "Christianity" => 2628920,
        //               "Hinduism" => 24182,
        //               "Islam" => 194229,
        //               "Judaism" => 1483,
        //               "Non-Religious" => 16460649,
        //               "Other Religions" => 36628274
        //             ),
        //             array(
        //               "Country" => "Lithuania",
        //               "Buddhism" => 544,
        //               "Christianity" => 2426434,
        //               "Hinduism" => 436,
        //               "Islam" => 3042,
        //               "Judaism" => 2818,
        //               "Non-Religious" => 288695,
        //               "Other Religions" => 322
        //             ),
        //             array(
        //               "Country" => "Nigeria",
        //               "Buddhism" => 11005,
        //               "Christianity" => 95186337,
        //               "Hinduism" => 39167,
        //               "Islam" => 94517305,
        //               "Judaism" => 1206,
        //               "Non-Religious" => 578046,
        //               "Other Religions" => 15806521
        //             ),
        //             array(
        //               "Country" => "Afghanistan",
        //               "Buddhism" => 7786,
        //               "Christianity" => 7544,
        //               "Hinduism" => 10511,
        //               "Islam" => 38874606,
        //               "Judaism" => ",
        //               "Non-Religious" => 3292,
        //               "Other Religions" => 24601
        //             ),
        //             array(
        //               "Country" => "Bahamas, The",
        //               "Buddhism" => ",
        //               "Christianity" => 365830,
        //               "Hinduism" => 118,
        //               "Islam" => 354,
        //               "Judaism" => 326,
        //               "Non-Religious" => 17480,
        //               "Other Religions" => 9140
        //             ),
        //             array(
        //               "Country" => "Eritrea",
        //               "Buddhism" => ",
        //               "Christianity" => 1655160,
        //               "Hinduism" => 1064,
        //               "Islam" => 1832425,
        //               "Judaism" => ",
        //               "Non-Religious" => 37633,
        //               "Other Religions" => 20147
        //             ),
        //             array(
        //               "Country" => "Philippines",
        //               "Buddhism" => 125597,
        //               "Christianity" => 99307046,
        //               "Hinduism" => 34277,
        //               "Islam" => 6065793,
        //               "Judaism" => 107,
        //               "Non-Religious" => 1046366,
        //               "Other Religions" => 3001899
        //             ),
        //             array(
        //               "Country" => "Russia",
        //               "Buddhism" => 554686,
        //               "Christianity" => 119945103,
        //               "Hinduism" => 43801,
        //               "Islam" => 17170005,
        //               "Judaism" => 135602,
        //               "Non-Religious" => 6995798,
        //               "Other Religions" => 1089465
        //             ),
        //             array(
        //               "Country" => "Timor-Leste",
        //               "Buddhism" => 2505,
        //               "Christianity" => 1157292,
        //               "Hinduism" => 396,
        //               "Islam" => 47341,
        //               "Judaism" => ",
        //               "Non-Religious" => 6289,
        //               "Other Religions" => 104619
        //             ),
        //             array(
        //               "Country" => "Djibouti",
        //               "Buddhism" => ",
        //               "Christianity" => 10869,
        //               "Hinduism" => 395,
        //               "Islam" => 965002,
        //               "Judaism" => ",
        //               "Non-Religious" => 10881,
        //               "Other Religions" => 855
        //             ),
        //             array(
        //               "Country" => "Latvia",
        //               "Buddhism" => 94,
        //               "Christianity" => 1529435,
        //               "Hinduism" => 705,
        //               "Islam" => 4762,
        //               "Judaism" => 8064,
        //               "Non-Religious" => 342916,
        //               "Other Religions" => 226
        //             ),
        //             array(
        //               "Country" => "Somalia",
        //               "Buddhism" => ",
        //               "Christianity" => 4168,
        //               "Hinduism" => 6357,
        //               "Islam" => 15866741,
        //               "Judaism" => ",
        //               "Non-Religious" => 2562,
        //               "Other Religions" => 13391
        //             ),
        //             array(
        //               "Country" => "Equatorial Guinea",
        //               "Buddhism" => ",
        //               "Christianity" => 1238447,
        //               "Hinduism" => 701,
        //               "Islam" => 56793,
        //               "Judaism" => ",
        //               "Non-Religious" => 77023,
        //               "Other Religions" => 30021
        //             ),
        //             array(
        //               "Country" => "Estonia",
        //               "Buddhism" => 708,
        //               "Christianity" => 494651,
        //               "Hinduism" => 708,
        //               "Islam" => 3667,
        //               "Judaism" => 1523,
        //               "Non-Religious" => 824787,
        //               "Other Religions" => 495
        //             ),
        //             array(
        //               "Country" => "Iran",
        //               "Buddhism" => 504,
        //               "Christianity" => 579343,
        //               "Hinduism" => 39348,
        //               "Islam" => 82770145,
        //               "Judaism" => 8055,
        //               "Non-Religious" => 247182,
        //               "Other Religions" => 348376
        //             ),
        //             array(
        //               "Country" => "Panama",
        //               "Buddhism" => 32991,
        //               "Christianity" => 3888212,
        //               "Hinduism" => 1942,
        //               "Islam" => 30728,
        //               "Judaism" => 10010,
        //               "Non-Religious" => 188198,
        //               "Other Religions" => 162687
        //             ),
        //             array(
        //               "Country" => "Sierra Leone",
        //               "Buddhism" => ",
        //               "Christianity" => 932957,
        //               "Hinduism" => 4092,
        //               "Islam" => 5217547,
        //               "Judaism" => ",
        //               "Non-Religious" => 97807,
        //               "Other Religions" => 1724582
        //             ),
        //             array(
        //               "Country" => "Belgium",
        //               "Buddhism" => 27896,
        //               "Christianity" => 7383690,
        //               "Hinduism" => 6954,
        //               "Islam" => 856313,
        //               "Judaism" => 29611,
        //               "Non-Religious" => 3246118,
        //               "Other Religions" => 39034
        //             ),
        //             array(
        //               "Country" => "Lesotho",
        //               "Buddhism" => ",
        //               "Christianity" => 1973803,
        //               "Hinduism" => 1285,
        //               "Islam" => 988,
        //               "Judaism" => ",
        //               "Non-Religious" => 5574,
        //               "Other Religions" => 160602
        //             ),
        //             array(
        //               "Country" => "Madagascar",
        //               "Buddhism" => 6923,
        //               "Christianity" => 16086959,
        //               "Hinduism" => 16061,
        //               "Islam" => 585819,
        //               "Judaism" => 305,
        //               "Non-Religious" => 95239,
        //               "Other Religions" => 10899713
        //             ),
        //             array(
        //               "Country" => "Spain",
        //               "Buddhism" => 14611,
        //               "Christianity" => 40525559,
        //               "Hinduism" => 26183,
        //               "Islam" => 1290827,
        //               "Judaism" => 50495,
        //               "Non-Religious" => 4802584,
        //               "Other Religions" => 44524
        //             ),
        //             array(
        //               "Country" => "Vietnam",
        //               "Buddhism" => 47333528,
        //               "Christianity" => 8927051,
        //               "Hinduism" => 58177,
        //               "Islam" => 173508,
        //               "Judaism" => 355,
        //               "Non-Religious" => 18310500,
        //               "Other Religions" => 22535464
        //             ),
        //             array(
        //               "Country" => "Austria",
        //               "Buddhism" => 11550,
        //               "Christianity" => 6221625,
        //               "Hinduism" => 7565,
        //               "Islam" => 638420,
        //               "Judaism" => 8466,
        //               "Non-Religious" => 2103095,
        //               "Other Religions" => 15679
        //             ),
        //             array(
        //               "Country" => "Burundi",
        //               "Buddhism" => ",
        //               "Christianity" => 11102372,
        //               "Hinduism" => 9988,
        //               "Islam" => 250425,
        //               "Judaism" => ",
        //               "Non-Religious" => 7241,
        //               "Other Religions" => 520756
        //             ),
        //             array(
        //               "Country" => "Channel Islands",
        //               "Buddhism" => 6,
        //               "Christianity" => 148177,
        //               "Hinduism" => 138,
        //               "Islam" => 135,
        //               "Judaism" => 110,
        //               "Non-Religious" => 24702,
        //               "Other Religions" => 591
        //             ),
        //             array(
        //               "Country" => "France",
        //               "Buddhism" => 495343,
        //               "Christianity" => 42496640,
        //               "Hinduism" => 49282,
        //               "Islam" => 5693788,
        //               "Judaism" => 442032,
        //               "Non-Religious" => 15536495,
        //               "Other Religions" => 559932
        //             ),
        //             array(
        //               "Country" => "Laos",
        //               "Buddhism" => 3814646,
        //               "Christianity" => 197803,
        //               "Hinduism" => 5820,
        //               "Islam" => 8585,
        //               "Judaism" => ",
        //               "Non-Religious" => 82899,
        //               "Other Religions" => 3165803
        //             ),
        //             array(
        //               "Country" => "Libya",
        //               "Buddhism" => 17728,
        //               "Christianity" => 36048,
        //               "Hinduism" => 6184,
        //               "Islam" => 6802198,
        //               "Judaism" => 131,
        //               "Non-Religious" => 3394,
        //               "Other Religions" => 5604
        //             ),
        //             array(
        //               "Country" => "Puerto Rico",
        //               "Buddhism" => 372,
        //               "Christianity" => 2739883,
        //               "Hinduism" => 2518,
        //               "Islam" => 830,
        //               "Judaism" => 2601,
        //               "Non-Religious" => 90722,
        //               "Other Religions" => 23914
        //             ),
        //             array(
        //               "Country" => "Dominica",
        //               "Buddhism" => 94,
        //               "Christianity" => 67971,
        //               "Hinduism" => 72,
        //               "Islam" => 101,
        //               "Judaism" => ",
        //               "Non-Religious" => 384,
        //               "Other Religions" => 3369
        //             ),
        //             array(
        //               "Country" => "Montserrat",
        //               "Buddhism" => ",
        //               "Christianity" => 4570,
        //               "Hinduism" => 5,
        //               "Islam" => ",
        //               "Judaism" => ",
        //               "Non-Religious" => 343,
        //               "Other Religions" => 81
        //             ),
        //             array(
        //               "Country" => "Thailand",
        //               "Buddhism" => 60846296,
        //               "Christianity" => 912335,
        //               "Hinduism" => 67987,
        //               "Islam" => 4100565,
        //               "Judaism" => 94,
        //               "Non-Religious" => 1256832,
        //               "Other Religions" => 2615869
        //             ),
        //             array(
        //               "Country" => "Tonga",
        //               "Buddhism" => 127,
        //               "Christianity" => 101262,
        //               "Hinduism" => 106,
        //               "Islam" => ",
        //               "Judaism" => ",
        //               "Non-Religious" => 457,
        //               "Other Religions" => 3745
        //             ),
        //             array(
        //               "Country" => "Germany",
        //               "Buddhism" => 86214,
        //               "Christianity" => 56377431,
        //               "Hinduism" => 95095,
        //               "Islam" => 5379950,
        //               "Judaism" => 127335,
        //               "Non-Religious" => 21616402,
        //               "Other Religions" => 101518
        //             ),
        //             array(
        //               "Country" => "Ireland",
        //               "Buddhism" => 864,
        //               "Christianity" => 4550469,
        //               "Hinduism" => 5234,
        //               "Islam" => 59229,
        //               "Judaism" => 2017,
        //               "Non-Religious" => 308741,
        //               "Other Religions" => 11242
        //             ),
        //             array(
        //               "Country" => "Greece",
        //               "Buddhism" => 4899,
        //               "Christianity" => 9337931,
        //               "Hinduism" => 13758,
        //               "Islam" => 607161,
        //               "Judaism" => 5511,
        //               "Non-Religious" => 436262,
        //               "Other Religions" => 17534
        //             ),
        //             array(
        //               "Country" => "Palau",
        //               "Buddhism" => 154,
        //               "Christianity" => 16690,
        //               "Hinduism" => 23,
        //               "Islam" => 430,
        //               "Judaism" => ",
        //               "Non-Religious" => 521,
        //               "Other Religions" => 274
        //             ),
        //             array(
        //               "Country" => "Sweden",
        //               "Buddhism" => 42529,
        //               "Christianity" => 5857323,
        //               "Hinduism" => 13371,
        //               "Islam" => 829308,
        //               "Judaism" => 17048,
        //               "Non-Religious" => 3291986,
        //               "Other Religions" => 47705
        //             ),
        //             array(
        //               "Country" => "Botswana",
        //               "Buddhism" => 1312,
        //               "Christianity" => 1647290,
        //               "Hinduism" => 3245,
        //               "Islam" => 6442,
        //               "Judaism" => 423,
        //               "Non-Religious" => 3839,
        //               "Other Religions" => 689074
        //             ),
        //             array(
        //               "Country" => "Zambia",
        //               "Buddhism" => 5515,
        //               "Christianity" => 15717006,
        //               "Hinduism" => 24965,
        //               "Islam" => 195847,
        //               "Judaism" => 51,
        //               "Non-Religious" => 33698,
        //               "Other Religions" => 2406874
        //             ),
        //             array(
        //               "Country" => "Congo, Democratic Republic of the",
        //               "Buddhism" => 5070,
        //               "Christianity" => 85061043,
        //               "Hinduism" => 134342,
        //               "Islam" => 1319713,
        //               "Judaism" => 404,
        //               "Non-Religious" => 400557,
        //               "Other Religions" => 2640275
        //             ),
        //             array(
        //               "Country" => "Swaziland",
        //               "Buddhism" => ",
        //               "Christianity" => 1013947,
        //               "Hinduism" => 1763,
        //               "Islam" => 7568,
        //               "Judaism" => ",
        //               "Non-Religious" => 13806,
        //               "Other Religions" => 123080
        //             ),
        //             array(
        //               "Country" => "Zimbabwe",
        //               "Buddhism" => 223,
        //               "Christianity" => 12149510,
        //               "Hinduism" => 22057,
        //               "Islam" => 108911,
        //               "Judaism" => 395,
        //               "Non-Religious" => 173694,
        //               "Other Religions" => 2408137
        //             ),
        //             array(
        //               "Country" => "Antigua and Barbuda",
        //               "Buddhism" => ",
        //               "Christianity" => 90801,
        //               "Hinduism" => 157,
        //               "Islam" => 543,
        //               "Judaism" => ",
        //               "Non-Religious" => 1835,
        //               "Other Religions" => 4592
        //             ),
        //             array(
        //               "Country" => "Lebanon",
        //               "Buddhism" => 141287,
        //               "Christianity" => 2339471,
        //               "Hinduism" => 11091,
        //               "Islam" => 4082958,
        //               "Judaism" => 104,
        //               "Non-Religious" => 239128,
        //               "Other Religions" => 11403
        //             ),
        //             array(
        //               "Country" => "Mozambique",
        //               "Buddhism" => 2719,
        //               "Christianity" => 17439492,
        //               "Hinduism" => 50321,
        //               "Islam" => 5459458,
        //               "Judaism" => 203,
        //               "Non-Religious" => 135585,
        //               "Other Religions" => 8167656
        //             ),
        //             array(
        //               "Country" => "Norway",
        //               "Buddhism" => 38751,
        //               "Christianity" => 4684810,
        //               "Hinduism" => 8755,
        //               "Islam" => 291543,
        //               "Judaism" => 902,
        //               "Non-Religious" => 376915,
        //               "Other Religions" => 19566
        //             ),
        //             array(
        //               "Country" => "Denmark",
        //               "Buddhism" => 21899,
        //               "Christianity" => 4695216,
        //               "Hinduism" => 9934,
        //               "Islam" => 304552,
        //               "Judaism" => 6985,
        //               "Non-Religious" => 741769,
        //               "Other Religions" => 11848
        //             ),
        //             array(
        //               "Country" => "Cambodia",
        //               "Buddhism" => 14380234,
        //               "Christianity" => 425533,
        //               "Hinduism" => 29977,
        //               "Islam" => 311996,
        //               "Judaism" => 151,
        //               "Non-Religious" => 416068,
        //               "Other Religions" => 1155012
        //             ),
        //             array(
        //               "Country" => "Cuba",
        //               "Buddhism" => 6154,
        //               "Christianity" => 6870206,
        //               "Hinduism" => 23446,
        //               "Islam" => 9175,
        //               "Judaism" => 817,
        //               "Non-Religious" => 2447632,
        //               "Other Religions" => 1969186
        //             ),
        //             array(
        //               "Country" => "Curacao",
        //               "Buddhism" => 815,
        //               "Christianity" => 153477,
        //               "Hinduism" => 341,
        //               "Islam" => 322,
        //               "Judaism" => 515,
        //               "Non-Religious" => 6085,
        //               "Other Religions" => 2545
        //             ),
        //             array(
        //               "Country" => "Isle of Man",
        //               "Buddhism" => ",
        //               "Christianity" => 71511,
        //               "Hinduism" => 179,
        //               "Islam" => 179,
        //               "Judaism" => 61,
        //               "Non-Religious" => 13102,
        //               "Other Religions" => "
        //             ),
        //             array(
        //               "Country" => "Malawi",
        //               "Buddhism" => ",
        //               "Christianity" => 15169355,
        //               "Hinduism" => 40907,
        //               "Islam" => 2686788,
        //               "Judaism" => 325,
        //               "Non-Religious" => 50940,
        //               "Other Religions" => 1181640
        //             ),
        //             array(
        //               "Country" => "Italy",
        //               "Buddhism" => 97404,
        //               "Christianity" => 46863171,
        //               "Hinduism" => 134825,
        //               "Islam" => 2800348,
        //               "Judaism" => 26754,
        //               "Non-Religious" => 10252025,
        //               "Other Religions" => 287301
        //             ),
        //             array(
        //               "Country" => "Portugal",
        //               "Buddhism" => 57204,
        //               "Christianity" => 9227949,
        //               "Hinduism" => 22433,
        //               "Islam" => 45178,
        //               "Judaism" => 470,
        //               "Non-Religious" => 811501,
        //               "Other Religions" => 31972
        //             ),
        //             array(
        //               "Country" => "Martinique",
        //               "Buddhism" => 150,
        //               "Christianity" => 360406,
        //               "Hinduism" => 891,
        //               "Islam" => 814,
        //               "Judaism" => ",
        //               "Non-Religious" => 10262,
        //               "Other Religions" => 2742
        //             ),
        //             array(
        //               "Country" => "Hong Kong",
        //               "Buddhism" => 1170156,
        //               "Christianity" => 1136414,
        //               "Hinduism" => 18443,
        //               "Islam" => 99735,
        //               "Judaism" => 5010,
        //               "Non-Religious" => 1677414,
        //               "Other Religions" => 3389816
        //             ),
        //             array(
        //               "Country" => "Cayman Islands",
        //               "Buddhism" => ",
        //               "Christianity" => 53618,
        //               "Hinduism" => 168,
        //               "Islam" => 127,
        //               "Judaism" => 597,
        //               "Non-Religious" => 3941,
        //               "Other Religions" => 7269
        //             ),
        //             array(
        //               "Country" => "Iceland",
        //               "Buddhism" => 590,
        //               "Christianity" => 317286,
        //               "Hinduism" => 886,
        //               "Islam" => 597,
        //               "Judaism" => ",
        //               "Non-Religious" => 17025,
        //               "Other Religions" => 4866
        //             ),
        //             array(
        //               "Country" => "Maldives",
        //               "Buddhism" => 3492,
        //               "Christianity" => 1557,
        //               "Hinduism" => 1561,
        //               "Islam" => 533435,
        //               "Judaism" => ",
        //               "Non-Religious" => 309,
        //               "Other Religions" => 188
        //             ),
        //             array(
        //               "Country" => "Cyprus",
        //               "Buddhism" => 7036,
        //               "Christianity" => 851367,
        //               "Hinduism" => 3588,
        //               "Islam" => 279031,
        //               "Judaism" => 206,
        //               "Non-Religious" => 54208,
        //               "Other Religions" => 11925
        //             ),
        //             array(
        //               "Country" => "Switzerland",
        //               "Buddhism" => 30966,
        //               "Christianity" => 6555049,
        //               "Hinduism" => 27131,
        //               "Islam" => 533519,
        //               "Judaism" => 18183,
        //               "Non-Religious" => 1480590,
        //               "Other Religions" => 9180
        //             ),
        //             array(
        //               "Country" => "Anguilla",
        //               "Buddhism" => ",
        //               "Christianity" => 13592,
        //               "Hinduism" => 60,
        //               "Islam" => 100,
        //               "Judaism" => 23,
        //               "Non-Religious" => 551,
        //               "Other Religions" => 676
        //             ),
        //             array(
        //               "Country" => "Virgin Islands (U.S.)",
        //               "Buddhism" => ",
        //               "Christianity" => 98660,
        //               "Hinduism" => 439,
        //               "Islam" => 110,
        //               "Judaism" => 348,
        //               "Non-Religious" => 4210,
        //               "Other Religions" => 656
        //             ),
        //             array(
        //               "Country" => "Barbados",
        //               "Buddhism" => 115,
        //               "Christianity" => 272858,
        //               "Hinduism" => 1379,
        //               "Islam" => 3105,
        //               "Judaism" => 34,
        //               "Non-Religious" => 5589,
        //               "Other Religions" => 4291
        //             ),
        //             array(
        //               "Country" => "United States (General)",
        //               "Buddhism" => 4300257,
        //               "Christianity" => 245457098,
        //               "Hinduism" => 1602582,
        //               "Islam" => 4564042,
        //               "Judaism" => 5578686,
        //               "Non-Religious" => 65115186,
        //               "Other Religions" => 4384796
        //             ),
        //             array(
        //               "Country" => "Andorra",
        //               "Buddhism" => ",
        //               "Christianity" => 70191,
        //               "Hinduism" => 382,
        //               "Islam" => 1023,
        //               "Judaism" => 264,
        //               "Non-Religious" => 5285,
        //               "Other Religions" => 120
        //             ),
        //             array(
        //               "Country" => "Guadeloupe",
        //               "Buddhism" => ",
        //               "Christianity" => 430129,
        //               "Hinduism" => 2243,
        //               "Islam" => 1660,
        //               "Judaism" => ",
        //               "Non-Religious" => 11111,
        //               "Other Religions" => 3528
        //             ),
        //             array(
        //               "Country" => "Kenya",
        //               "Buddhism" => 1694,
        //               "Christianity" => 43554099,
        //               "Hinduism" => 268682,
        //               "Islam" => 4232760,
        //               "Judaism" => 299,
        //               "Non-Religious" => 52296,
        //               "Other Religions" => 5661470
        //             ),
        //             array(
        //               "Country" => "Jamaica",
        //               "Buddhism" => 355,
        //               "Christianity" => 2503656,
        //               "Hinduism" => 17619,
        //               "Islam" => 2615,
        //               "Judaism" => 586,
        //               "Non-Religious" => 123384,
        //               "Other Religions" => 312946
        //             ),
        //             array(
        //               "Country" => "Yemen",
        //               "Buddhism" => 162,
        //               "Christianity" => 16519,
        //               "Hinduism" => 187904,
        //               "Islam" => 29599758,
        //               "Judaism" => 60,
        //               "Non-Religious" => 18245,
        //               "Other Religions" => 3320
        //             ),
        //             array(
        //               "Country" => "Netherlands",
        //               "Buddhism" => 205722,
        //               "Christianity" => 9514604,
        //               "Hinduism" => 110540,
        //               "Islam" => 1225417,
        //               "Judaism" => 30055,
        //               "Non-Religious" => 5982406,
        //               "Other Religions" => 66129
        //             ),
        //             array(
        //               "Country" => "Grenada",
        //               "Buddhism" => ",
        //               "Christianity" => 108667,
        //               "Hinduism" => 765,
        //               "Islam" => 369,
        //               "Judaism" => ",
        //               "Non-Religious" => 1076,
        //               "Other Religions" => 1642
        //             ),
        //             array(
        //               "Country" => "Uganda",
        //               "Buddhism" => 2744,
        //               "Christianity" => 38623764,
        //               "Hinduism" => 367483,
        //               "Islam" => 5359536,
        //               "Judaism" => 2058,
        //               "Non-Religious" => 196103,
        //               "Other Religions" => 1189311
        //             ),
        //             array(
        //               "Country" => "Brunei",
        //               "Buddhism" => 42281,
        //               "Christianity" => 52010,
        //               "Hinduism" => 3719,
        //               "Islam" => 257650,
        //               "Judaism" => ",
        //               "Non-Religious" => 5146,
        //               "Other Religions" => 76677
        //             ),
        //             array(
        //               "Country" => "Tanzania",
        //               "Buddhism" => 13530,
        //               "Christianity" => 33050100,
        //               "Hinduism" => 516831,
        //               "Islam" => 18849101,
        //               "Judaism" => 296,
        //               "Non-Religious" => 212791,
        //               "Other Religions" => 7091564
        //             ),
        //             array(
        //               "Country" => "Saint Lucia",
        //               "Buddhism" => ",
        //               "Christianity" => 176129,
        //               "Hinduism" => 1676,
        //               "Islam" => 852,
        //               "Judaism" => ",
        //               "Non-Religious" => 752,
        //               "Other Religions" => 4220
        //             ),
        //             array(
        //               "Country" => "United Kingdom",
        //               "Buddhism" => 213125,
        //               "Christianity" => 45742020,
        //               "Hinduism" => 689233,
        //               "Islam" => 4269225,
        //               "Judaism" => 277857,
        //               "Non-Religious" => 15819182,
        //               "Other Religions" => 875362
        //             ),
        //             array(
        //               "Country" => "British Virgin Islands",
        //               "Buddhism" => ",
        //               "Christianity" => 24691,
        //               "Hinduism" => 360,
        //               "Islam" => 349,
        //               "Judaism" => ",
        //               "Non-Religious" => 2071,
        //               "Other Religions" => 2766
        //             ),
        //             array(
        //               "Country" => "Canada",
        //               "Buddhism" => 652186,
        //               "Christianity" => 23951800,
        //               "Hinduism" => 476921,
        //               "Islam" => 1106517,
        //               "Judaism" => 361174,
        //               "Non-Religious" => 9620641,
        //               "Other Religions" => 1572918
        //             ),
        //             array(
        //               "Country" => "Pakistan",
        //               "Buddhism" => 115909,
        //               "Christianity" => 4187911,
        //               "Hinduism" => 2913456,
        //               "Islam" => 213085718,
        //               "Judaism" => 906,
        //               "Non-Religious" => 187030,
        //               "Other Religions" => 401401
        //             ),
        //             array(
        //               "Country" => "Seychelles",
        //               "Buddhism" => ",
        //               "Christianity" => 93098,
        //               "Hinduism" => 1436,
        //               "Islam" => 885,
        //               "Judaism" => ",
        //               "Non-Religious" => 2339,
        //               "Other Religions" => 582
        //             ),
        //             array(
        //               "Country" => "Saint Kitts and Nevis",
        //               "Buddhism" => ",
        //               "Christianity" => 50329,
        //               "Hinduism" => 798,
        //               "Islam" => 133,
        //               "Judaism" => ",
        //               "Non-Religious" => 847,
        //               "Other Religions" => 1085
        //             ),
        //             array(
        //               "Country" => "French Guiana",
        //               "Buddhism" => ",
        //               "Christianity" => 251484,
        //               "Hinduism" => 4779,
        //               "Islam" => 2740,
        //               "Judaism" => 121,
        //               "Non-Religious" => 10178,
        //               "Other Religions" => 29380
        //             ),
        //             array(
        //               "Country" => "Indonesia",
        //               "Buddhism" => 2185407,
        //               "Christianity" => 33409114,
        //               "Hinduism" => 4427912,
        //               "Islam" => 216408788,
        //               "Judaism" => 210,
        //               "Non-Religious" => 3932676,
        //               "Other Religions" => 13159514
        //             ),
        //             array(
        //               "Country" => "Burma (Myanmar)",
        //               "Buddhism" => 40469474,
        //               "Christianity" => 4310599,
        //               "Hinduism" => 928149,
        //               "Islam" => 2046856,
        //               "Judaism" => 33,
        //               "Non-Religious" => 263720,
        //               "Other Religions" => 6390963
        //             ),
        //             array(
        //               "Country" => "Gibraltar",
        //               "Buddhism" => ",
        //               "Christianity" => 29858,
        //               "Hinduism" => 606,
        //               "Islam" => 1645,
        //               "Judaism" => 590,
        //               "Non-Religious" => 878,
        //               "Other Religions" => 114
        //             ),
        //             array(
        //               "Country" => "Australia",
        //               "Buddhism" => 797015,
        //               "Christianity" => 14620214,
        //               "Hinduism" => 470023,
        //               "Islam" => 745513,
        //               "Judaism" => 108228,
        //               "Non-Religious" => 8112848,
        //               "Other Religions" => 646042
        //             ),
        //             array(
        //               "Country" => "New Zealand",
        //               "Buddhism" => 154246,
        //               "Christianity" => 2624213,
        //               "Hinduism" => 94820,
        //               "Islam" => 72692,
        //               "Judaism" => 5748,
        //               "Non-Religious" => 1770732,
        //               "Other Religions" => 99782
        //             ),
        //             array(
        //               "Country" => "Belize",
        //               "Buddhism" => 1948,
        //               "Christianity" => 366850,
        //               "Hinduism" => 7873,
        //               "Islam" => 2004,
        //               "Judaism" => 107,
        //               "Non-Religious" => 2382,
        //               "Other Religions" => 16457
        //             ),
        //             array(
        //               "Country" => "Saudi Arabia",
        //               "Buddhism" => 113632,
        //               "Christianity" => 2102068,
        //               "Hinduism" => 708114,
        //               "Islam" => 31461249,
        //               "Judaism" => ",
        //               "Non-Religious" => 241847,
        //               "Other Religions" => 186957
        //             ),
        //             array(
        //               "Country" => "South Africa",
        //               "Buddhism" => 247584,
        //               "Christianity" => 48520343,
        //               "Hinduism" => 1414305,
        //               "Islam" => 1022589,
        //               "Judaism" => 65477,
        //               "Non-Religious" => 3357797,
        //               "Other Religions" => 4680595
        //             ),
        //             array(
        //               "Country" => "Qatar",
        //               "Buddhism" => 54740,
        //               "Christianity" => 399618,
        //               "Hinduism" => 95075,
        //               "Islam" => 2264299,
        //               "Judaism" => ",
        //               "Non-Religious" => 64519,
        //               "Other Religions" => 2809
        //             ),
        //             array(
        //               "Country" => "Saint Vincent and the Grenadines",
        //               "Buddhism" => ",
        //               "Christianity" => 98328,
        //               "Hinduism" => 3722,
        //               "Islam" => 1653,
        //               "Judaism" => ",
        //               "Non-Religious" => 2808,
        //               "Other Religions" => 4436
        //             ),
        //             array(
        //               "Country" => "Kuwait",
        //               "Buddhism" => ",
        //               "Christianity" => 507962,
        //               "Hinduism" => 161086,
        //               "Islam" => 3535586,
        //               "Judaism" => ",
        //               "Non-Religious" => 37967,
        //               "Other Religions" => 27962
        //             ),
        //             array(
        //               "Country" => "Reunion",
        //               "Buddhism" => 1662,
        //               "Christianity" => 783689,
        //               "Hinduism" => 40378,
        //               "Islam" => 37306,
        //               "Judaism" => ",
        //               "Non-Religious" => 18686,
        //               "Other Religions" => 13587
        //             ),
        //             array(
        //               "Country" => "Singapore",
        //               "Buddhism" => 871779,
        //               "Christianity" => 1209487,
        //               "Hinduism" => 306247,
        //               "Islam" => 880543,
        //               "Judaism" => 789,
        //               "Non-Religious" => 279345,
        //               "Other Religions" => 2302153
        //             ),
        //             array(
        //               "Country" => "Oman",
        //               "Buddhism" => 39576,
        //               "Christianity" => 185207,
        //               "Hinduism" => 278617,
        //               "Islam" => 4542373,
        //               "Judaism" => ",
        //               "Non-Religious" => 7897,
        //               "Other Religions" => 52952
        //             ),
        //             array(
        //               "Country" => "United Arab Emirates",
        //               "Buddhism" => 187870,
        //               "Christianity" => 1114172,
        //               "Hinduism" => 610089,
        //               "Islam" => 7727870,
        //               "Judaism" => ",
        //               "Non-Religious" => 124791,
        //               "Other Religions" => 125608
        //             ),
        //             array(
        //               "Country" => "Malaysia",
        //               "Buddhism" => 1711935,
        //               "Christianity" => 2969589,
        //               "Hinduism" => 2009303,
        //               "Islam" => 18289460,
        //               "Judaism" => 107,
        //               "Non-Religious" => 155142,
        //               "Other Religions" => 7230462
        //             ),
        //             array(
        //               "Country" => "Bahrain",
        //               "Buddhism" => 3718,
        //               "Christianity" => 205437,
        //               "Hinduism" => 108588,
        //               "Islam" => 1371164,
        //               "Judaism" => 62,
        //               "Non-Religious" => 7622,
        //               "Other Religions" => 4992
        //             ),
        //             array(
        //               "Country" => "Bangladesh",
        //               "Buddhism" => 1181633,
        //               "Christianity" => 914776,
        //               "Hinduism" => 15446881,
        //               "Islam" => 146253593,
        //               "Judaism" => 198,
        //               "Non-Religious" => 130414,
        //               "Other Religions" => 761888
        //             ),
        //             array(
        //               "Country" => "Bhutan",
        //               "Buddhism" => 638507,
        //               "Christianity" => 17570,
        //               "Hinduism" => 88218,
        //               "Islam" => 1736,
        //               "Judaism" => ",
        //               "Non-Religious" => 208,
        //               "Other Religions" => 25373
        //             ),
        //             array(
        //               "Country" => "Sri Lanka",
        //               "Buddhism" => 14559345,
        //               "Christianity" => 1975686,
        //               "Hinduism" => 2793851,
        //               "Islam" => 1938392,
        //               "Judaism" => 86,
        //               "Non-Religious" => 120584,
        //               "Other Religions" => 25306
        //             ),
        //             array(
        //               "Country" => "Suriname",
        //               "Buddhism" => 3474,
        //               "Christianity" => 299192,
        //               "Hinduism" => 120631,
        //               "Islam" => 93254,
        //               "Judaism" => 205,
        //               "Non-Religious" => 27971,
        //               "Other Religions" => 41907
        //             ),
        //             array(
        //               "Country" => "Trinidad and Tobago",
        //               "Buddhism" => 4358,
        //               "Christianity" => 887663,
        //               "Hinduism" => 340564,
        //               "Islam" => 90184,
        //               "Judaism" => 104,
        //               "Non-Religious" => 32495,
        //               "Other Religions" => 44123
        //             ),
        //             array(
        //               "Country" => "Fiji",
        //               "Buddhism" => ",
        //               "Christianity" => 572946,
        //               "Hinduism" => 248656,
        //               "Islam" => 55617,
        //               "Judaism" => 119,
        //               "Non-Religious" => 9406,
        //               "Other Religions" => 9700
        //             ),
        //             array(
        //               "Country" => "Guyana",
        //               "Buddhism" => 1888,
        //               "Christianity" => 424900,
        //               "Hinduism" => 242622,
        //               "Islam" => 59169,
        //               "Judaism" => 61,
        //               "Non-Religious" => 16610,
        //               "Other Religions" => 41309
        //             ),
        //             array(
        //               "Country" => "Mauritius",
        //               "Buddhism" => 3154,
        //               "Christianity" => 420412,
        //               "Hinduism" => 562241,
        //               "Islam" => 214240,
        //               "Judaism" => ",
        //               "Non-Religious" => 25484,
        //               "Other Religions" => 46236
        //             ),
        //             array(
        //               "Country" => "Nepal",
        //               "Buddhism" => 3545857,
        //               "Christianity" => 1253412,
        //               "Hinduism" => 19172595,
        //               "Islam" => 1187282,
        //               "Judaism" => ",
        //               "Non-Religious" => 99813,
        //               "Other Religions" => 3877849
        //             ),
        //             array(
        //               "Country" => "India",
        //               "Buddhism" => 9798665,
        //               "Christianity" => 66315897,
        //               "Hinduism" => 999122378,
        //               "Islam" => 198476545,
        //               "Judaism" => 4830,
        //               "Non-Religious" => 18530458,
        //               "Other Religions" => 87755612
        //             )
        //     ]
        // ];

    //     return $mapPopulation;
    // }

    public function getMapPins() {
        $mapPins = [
            "Birth of Siddhartha Guatama" => [
                "pinid" => "pin1",
                "pinType" => "event",
                "religion" => "Buddhism",
                "country" => "Nepal",
                "timelineDate" => "2000 CE",
                "displayDate" => "490 BCE",
                "shortDesc" => "Siddhartha Gautama, known as the Buddha, was born in the sixth century BCE in what is now modern Nepal.",
                "description" => "Siddhartha Gautama, known as the Buddha, was born in the sixth century BCE in what is now modern Nepal. <br> For six years, Siddhartha submitted himself to rigorous ascetic practices, studying and following different methods of meditation with various religious teachers. But he was never fully satisfied. One day, however, he was offered a bowl of rice from a young girl and he accepted it. In that moment, he realised that physical austerities were not the means to achieve liberation. From then on, he encouraged people to follow a path of balance rather than extremism. He called this The Middle Way. <br> That night Siddhartha sat under the Bodhi tree, and meditated until dawn. He purified his mind of all defilements and attained enlightenment at the age of thirty-five, thus earning the title Buddha, or &#8220;Enlightened One&#8220;. For the remainder of his eighty years, the Buddha preached the Dharma in an effort to help other sentient beings reach enlightenment.",
                "relatedPerson" => "Siddhartha Guatama",
                "pinVid" => "",
                "pinImg1" => "",
                "pinImg2" => "",
                "source" => ["https://www.buddhanet.net/e-learning/history/b_chron-txt.htm"]
            ],  
            "Emperor Asoka" => [
                "pinid" => "pin2",
                "pinType" => "person",
                "religion" => "Buddhism",
                "country" => "India",
                "timelineDate" => "2010 CE",
                "displayDate" => "207 - 230",
                "shortDesc" => "Indian Emperor Asoka converts and establishes the Buddha\'s Dharma on a national level for the first time.",
                "description" => "India\'s foremost royal patron of Buddhism and the first monarch to rule over a united India. Emperor of India, founder of the Maurya Dynasty. A great Buddhist ruler who was converted to Buddhism after a long period of wars of conquest. He abolished wars in his Empire, restricted hunting or killing for food, built hospital for man and beast, and engraved on rocks and pillars throughout the Empire his famous Edicts, setting forth the moral precepts of Buddhism. He sent his son Mahinda and daughter Sanghamitta to Sri Lanka where they converted the ruler and people to Buddhism. The Third Buddhist Council was held at his capitial Pajaliputra, India, in the seventeenth year of his reign.",
                "relatedPerson" => "",
                "pinVid" => "",
                "pinImg1" => "",
                "pinImg2" => "",
                "source" => ["https://www.buddhanet.net/e-learning/history/b_chron-txt.htm"]
            ], 
            "Angkor Wat" => [
                "pinid" => "pin3",
                "pinType" => "location",
                "religion" => "Buddhism",
                "country" => "Cambodia",
                "timelineDate" => "2010 CE",
                "displayDate" => "1110 - Present",
                "shortDesc" => "Khmer kings build Angkor Wat around the year 1110 - 1150, the world\'s largest religious monument",
                "description" => "After a horrifying period of war, the Hindu temple complex of Angkor Wat and the Buddhist Angkor Thom are again accessible. Angkor Thom was the creation of the Khmer &#8220;god-king&#8220; Jayavarman VII (1181-1219), who converted to Mahayana following the destruction of Angkor by the Cham (Vietnamese) during his father\'s reign. Jayavarman\'s Buddhism seems to have been a revised version of the Brahmanical religion which previous Khmer kings had exploited to deify their own persons. The central deity in Jayavarman\'s religion was Lokeshvara, &#8220;Lord of the Worlds&#8220;, and rebuilding Angkor Thom on a stupendously grand scale, the king created a &#8220;Buddhist&#8220; city as a monument to Lokeshvara, who was an aspect of Jayavarman\'s divine self. This convergence of king and deity is still visible in the portrait masks of Jayavarman carved on the four faces of the Bayon temple towers of Angkor Thorn.",
                "relatedPerson" => "Khmer Jayavarman VII",
                "pinVid" => "https://www.shutterstock.com/shutterstock/videos/1029323123/preview/stock-footage-famous-colonnade-of-st-peter-s-basilica-in-vatic.webm",
                "pinImg1" => "../assets/data/map/img/angkor-wat1.jpg",
                "pinImg2" => "../assets/data/map/img/angkor-wat2.jpg",
                "source" => ["https://www.buddhanet.net/e-learning/history/b_chron-txt.htm"]
            ],
            "Calling of Abraham" => [
                "pinid" => "pin4",
                "pinType" => "event",
                "religion" => "Christianity",
                "country" => "Iraq",
                "timelineDate" => "2010 CE",
                "displayDate" => "2100 BCE",
                "shortDesc" => "God calls on a man named Abram, makes a covenant with him, promising to make his descendants into a great nation.",
                "description" => "When God first called Abraham, he was known as Abram. But God changed his name to Abraham, a name that means, &#8220;the father is exalted.&#8220; <br> The story of Abraham begins in Genesis 12, when God called Abram to leave everything behind and follow Him to a new land that He would show him. It was a call to a life of faith and trust in God\'s promises, even when the way ahead was uncertain. Through Abraham\'s faith, God fulfilled His promises and made him the father of many nations, including the nation of Israel.",
                "relatedPerson" => "Abraham",
                "pinVid" => "",
                "pinImg1" => "",
                "pinImg2" => "",
                "source" => ["http://www.faithfirst.com/teachers/bible-story-call-abraham-genesis-121-9", "https://viralbeliever.com/the-call-of-abraham-a-summary-kgr323/"]
            ],
            "Jacob" => [
                "pinid" => "pin5",
                "pinType" => "person",
                "religion" => "Christianity",
                "country" => "Israel",
                "timelineDate" => "2010 CE",
                "displayDate" => "2000 BCE",
                "shortDesc" => "Jacob is a biblical hero who depicts the power and grace of God to change and renew.",
                "description" => "Jacob is most commonly known in the Bible for his cunning and deceitful ways, especially towards his twin brother Esau. He offered his &#8220;famished&#8220; brother a bowl of soup in exchange for his birthright as the firstborn son, which was a double portion of his father Isaac\'s inheritance (Genesis 25:29-34). Moreover, Jacob robbed Esau of their father\'s blessing (Genesis 27:1-29, Genesis 27:35), which had been Esau\'s right to receive. However, after losing to God in a wrestling match, Jacob received God\'s blessings and a new name: Israel.",
                "relatedPerson" => "Esau",
                "pinVid" => "",
                "pinImg1" => "",
                "pinImg2" => "",
                "source" => ["https://www.christianity.com/wiki/people/who-was-jacob-in-the-bible-why-did-jacob-wrestle-with-god.html"]
            ],
            "Bethlehem" => [
                "pinid" => "pin6",
                "pinType" => "location",
                "religion" => "Christianity",
                "country" => "Palestine",
                "timelineDate" => "2000 CE",
                "displayDate" => "10 BCE",
                "shortDesc" => "The West Bank city of Bethlehem, about 9km south of Jerusalem, is celebrated by Christians as the birthplace of Jesus Christ.",
                "description" => "Bethlehem birthplace of Jesus Christ is situated on the West Bank area of Palestine. It is the holy pilgrimage site for Christians from all around the World. It is located in the middle of the Judeau Mountain Range, sandwiched between Israel and Jordan. It is believed that Jesus was born in the animal shelter in Bethlehem as Mary and Joseph could not be housed in the overcrowded Inn because of the ongoing census. The baby was swaddled and placed in a manger (water trough) in the cave. The caves were used as animal shelters and storage units while houses were built near them.",
                "relatedPerson" => "Jesus Christ",
                "pinVid" => "",
                "pinImg1" => "",
                "pinImg2" => "",
                "source" => ["https://www.seetheholyland.net/tag/birthplace-of-christ/", "https://traveltriangle.com/blog/bethlehem-birthplace-of-jesus-christ/"]
            ],
            // "Pin Title" => [
            //     "pinType" => "",
            //     "religion" => "",
            //     "country" => "",
            //     "timelineDate" => "",
            //     "displayDate" => "",
            //     "shortDesc" => "",
            //     "description" => "",
            //     "relatedPerson" => "",
            //     "pinVid" => "",
            //     "pinImg1" => "",
            //     "pinImg2" => "",
            //     "source" => [""]
            // ],
        ];

        return $mapPins;
    }
}

?>