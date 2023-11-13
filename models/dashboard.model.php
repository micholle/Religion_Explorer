<?php
require_once "connection.php";

class dashboardModel {

    static public function mdlGetDashboardData($data) {
        $db = new Connection();
        $pdo = $db->connect();

        $adminDashboardYear = $data["adminDashboardYear"];
        $adminDashboardMonth = $data["adminDashboardMonth"];
        $adminDashboardWeek = $data["adminDashboardWeek"];
        
        $accessLogActiveStmt = $pdo->prepare("SELECT * FROM accesslog WHERE status='registered'");
        $accessLogActiveStmt->execute();
        $accessLogActiveResults = $accessLogActiveStmt->fetchAll(PDO::FETCH_ASSOC);
        
        $accessLogGuestStmt = $pdo->prepare("SELECT * FROM accesslog WHERE status='guest'");
        $accessLogGuestStmt->execute();
        $accessLogGuestResults = $accessLogGuestStmt->fetchAll(PDO::FETCH_ASSOC);

        $accountsStmt = $pdo->prepare("SELECT * FROM accounts");
        $accountsStmt->execute();
        $accountsResults = $accountsStmt->fetchAll(PDO::FETCH_ASSOC);

        $userActivityStmt = $pdo->prepare("SELECT * FROM explorerpoints");
        $userActivityStmt->execute();
        $userActivityResults = $userActivityStmt->fetchAll(PDO::FETCH_ASSOC);

        $bookmarksStmt = $pdo->prepare("SELECT * FROM bookmarks");
        $bookmarksStmt->execute();
        $bookmarksResults = $bookmarksStmt->fetchAll(PDO::FETCH_ASSOC);

        $communityStmt = $pdo->prepare("SELECT * FROM communitycreations");
        $communityStmt->execute();
        $communityResults = $communityStmt->fetchAll(PDO::FETCH_ASSOC);

        $topicStmt = $pdo->prepare("SELECT * FROM topics");
        $topicStmt->execute();
        $topicResults = $topicStmt->fetchAll(PDO::FETCH_ASSOC);

        $postStmt = $pdo->prepare("SELECT * FROM posts");
        $postStmt->execute();
        $postResults = $postStmt->fetchAll(PDO::FETCH_ASSOC);

        $replyStmt = $pdo->prepare("SELECT * FROM reply");
        $replyStmt->execute();
        $replyResults = $replyStmt->fetchAll(PDO::FETCH_ASSOC);

        $calendarStmt = $pdo->prepare("SELECT * FROM personalcalendar");
        $calendarStmt->execute();
        $calendarResults = $calendarStmt->fetchAll(PDO::FETCH_ASSOC);

        $contentStmt = $pdo->prepare("SELECT * FROM reportedcontent");
        $contentStmt->execute();
        $contentResults = $contentStmt->fetchAll(PDO::FETCH_ASSOC);

        $userStmt = $pdo->prepare("SELECT * FROM reportedusers");
        $userStmt->execute();
        $userResults = $userStmt->fetchAll(PDO::FETCH_ASSOC);

        $dashboardData = [];

        if ($adminDashboardMonth == "allMonths") {
            $registeredBuddhists = 0;
            $registeredChristians = 0;
            $registeredHindus = 0;
            $registeredIslams = 0;
            $registeredJews = 0;
            $registeredOtherReligions = 0;
            $registeredNonReligious = 0;

            $januaryUsersPrevious = 0;
            $februaryUsersPrevious = 0;
            $marchUsersPrevious = 0;
            $aprilUsersPrevious = 0;
            $mayUsersPrevious = 0;
            $juneUsersPrevious = 0;
            $julyUsersPrevious = 0;
            $augustUsersPrevious = 0;
            $septemberUsersPrevious = 0;
            $octoberUsersPrevious = 0;
            $novemberUsersPrevious = 0;
            $decemberUsersPrevious = 0;

            $januaryUsersCurrent = 0;
            $februaryUsersCurrent = 0;
            $marchUsersCurrent = 0;
            $aprilUsersCurrent = 0;
            $mayUsersCurrent = 0;
            $juneUsersCurrent = 0;
            $julyUsersCurrent = 0;
            $augustUsersCurrent = 0;
            $septemberUsersCurrent = 0;
            $octoberUsersCurrent = 0;
            $novemberUsersCurrent = 0;
            $decemberUsersCurrent = 0;

            $januaryUserActivityMap = 0;
            $februaryUserActivityMap = 0;
            $marchUserActivityMap = 0;
            $aprilUserActivityMap = 0;
            $mayUserActivityMap = 0;
            $juneUserActivityMap = 0;
            $julyUserActivityMap = 0;
            $augustUserActivityMap = 0;
            $septemberUserActivityMap = 0;
            $octoberUserActivityMap = 0;
            $novemberUserActivityMap = 0;
            $decemberUserActivityMap = 0;

            $januaryUserActivityLibrary = 0;
            $februaryUserActivityLibrary = 0;
            $marchUserActivityLibrary = 0;
            $aprilUserActivityLibrary = 0;
            $mayUserActivityLibrary = 0;
            $juneUserActivityLibrary = 0;
            $julyUserActivityLibrary = 0;
            $augustUserActivityLibrary = 0;
            $septemberUserActivityLibrary = 0;
            $octoberUserActivityLibrary = 0;
            $novemberUserActivityLibrary = 0;
            $decemberUserActivityLibrary = 0;

            $januaryUserActivityCommunity = 0;
            $februaryUserActivityCommunity = 0;
            $marchUserActivityCommunity = 0;
            $aprilUserActivityCommunity = 0;
            $mayUserActivityCommunity = 0;
            $juneUserActivityCommunity = 0;
            $julyUserActivityCommunity = 0;
            $augustUserActivityCommunity = 0;
            $septemberUserActivityCommunity = 0;
            $octoberUserActivityCommunity = 0;
            $novemberUserActivityCommunity = 0;
            $decemberUserActivityCommunity = 0;

            $januaryUserActivityForum = 0;
            $februaryUserActivityForum = 0;
            $marchUserActivityForum = 0;
            $aprilUserActivityForum = 0;
            $mayUserActivityForum = 0;
            $juneUserActivityForum = 0;
            $julyUserActivityForum = 0;
            $augustUserActivityForum = 0;
            $septemberUserActivityForum = 0;
            $octoberUserActivityForum = 0;
            $novemberUserActivityForum = 0;
            $decemberUserActivityForum = 0;

            $januaryUserActivityCalendar = 0;
            $februaryUserActivityCalendar = 0;
            $marchUserActivityCalendar = 0;
            $aprilUserActivityCalendar = 0;
            $mayUserActivityCalendar = 0;
            $juneUserActivityCalendar = 0;
            $julyUserActivityCalendar = 0;
            $augustUserActivityCalendar = 0;
            $septemberUserActivityCalendar = 0;
            $octoberUserActivityCalendar = 0;
            $novemberUserActivityCalendar = 0;
            $decemberUserActivityCalendar = 0;

            // User Activity Map
            $buddhismUserActivityMap = 0;
            $christianityUserActivityMap = 0;
            $hinduismUserActivityMap = 0;
            $islamUserActivityMap = 0;
            $judaismUserActivityMap = 0;
            $otherReligionsUserActivityMap = 0;
            $nonReligiousUserActivityMap = 0;

            // User Activity Library
            $buddhismUserActivityLibrary = 0;
            $christianityUserActivityLibrary = 0;
            $hinduismUserActivityLibrary = 0;
            $islamUserActivityLibrary = 0;
            $judaismUserActivityLibrary = 0;
            $otherReligionsUserActivityLibrary = 0;
            $nonReligiousUserActivityLibrary = 0;

            // User Activity Community
            $buddhismUserActivityCommunity = 0;
            $christianityUserActivityCommunity = 0;
            $hinduismUserActivityCommunity = 0;
            $islamUserActivityCommunity = 0;
            $judaismUserActivityCommunity = 0;
            $otherReligionsUserActivityCommunity = 0;
            $nonReligiousUserActivityCommunity = 0;

            // User Activity Forum
            $buddhismUserActivityForum = 0;
            $christianityUserActivityForum = 0;
            $hinduismUserActivityForum = 0;
            $islamUserActivityForum = 0;
            $judaismUserActivityForum = 0;
            $otherReligionsUserActivityForum = 0;
            $nonReligiousUserActivityForum = 0;

            // User Activity Calendar
            $buddhismUserActivityCalendar = 0;
            $christianityUserActivityCalendar = 0;
            $hinduismUserActivityCalendar = 0;
            $islamUserActivityCalendar = 0;
            $judaismUserActivityCalendar = 0;
            $otherReligionsUserActivityCalendar = 0;
            $nonReligiousUserActivityCalendar = 0;

            $januaryReportedContent = 0;
            $februaryReportedContent = 0;
            $marchReportedContent = 0;
            $aprilReportedContent = 0;
            $mayReportedContent = 0;
            $juneReportedContent = 0;
            $julyReportedContent = 0;
            $augustReportedContent = 0;
            $septemberReportedContent = 0;
            $octoberReportedContent = 0;
            $novemberReportedContent = 0;
            $decemberReportedContent = 0;

            $januaryReportedUsers = 0;
            $februaryReportedUsers = 0;
            $marchReportedUsers = 0;
            $aprilReportedUsers = 0;
            $mayReportedUsers = 0;
            $juneReportedUsers = 0;
            $julyReportedUsers = 0;
            $augustReportedUsers = 0;
            $septemberReportedUsers = 0;
            $octoberReportedUsers = 0;
            $novemberReportedUsers = 0;
            $decemberReportedUsers = 0;

            $filteredResultsAccessLogActive = array_filter($accessLogActiveResults, function ($row) use ($adminDashboardYear) {
                $accessLogDate = new DateTime($row['datetime']);
                return $accessLogDate->format('Y') == $adminDashboardYear || $accessLogDate->format('Y') == ($adminDashboardYear - 1);
            });
            $filteredResultsAccessLogGuest = array_filter($accessLogGuestResults, function ($row) use ($adminDashboardYear) {
                $accessLogDate = new DateTime($row['datetime']);
                return $accessLogDate->format('Y') == $adminDashboardYear || $accessLogDate->format('Y') == ($adminDashboardYear - 1);
            });  
            $filteredResultsAccounts = array_filter($accountsResults, function ($row) use ($adminDashboardYear) {
                $accountDate = new DateTime($row['accountDate']);
                return $accountDate->format('Y') == $adminDashboardYear || $accountDate->format('Y') == ($adminDashboardYear - 1);
            }); 
            $filteredResultsUserActvity = array_filter($userActivityResults, function ($row) use ($adminDashboardYear) {
                $userActivityDate = new DateTime($row['datetime']);
                return $userActivityDate->format('Y') == $adminDashboardYear || $userActivityDate->format('Y') == ($adminDashboardYear - 1);
            });            
            $filteredResultsBookmarks = array_filter($bookmarksResults, function ($row) use ($adminDashboardYear) {
                $bookmarksDate = new DateTime($row['datetime']);
                return $bookmarksDate->format('Y') == $adminDashboardYear;
            });   
            $filteredResultsCommunity = array_filter($communityResults, function ($row) use ($adminDashboardYear) {
                $communityDate = new DateTime($row['date']);
                return $communityDate->format('Y') == $adminDashboardYear;
            });  
            $filteredResultsTopics = array_filter($topicResults, function ($row) use ($adminDashboardYear) {
                $topicDate = new DateTime($row['topicDate']);
                return $topicDate->format('Y') == $adminDashboardYear;
            });  
            $filteredResultsPosts = array_filter($postResults, function ($row) use ($adminDashboardYear) {
                $postDate = new DateTime($row['postDate']);
                return $postDate->format('Y') == $adminDashboardYear;
            });  
            $filteredResultsReplies = array_filter($replyResults, function ($row) use ($adminDashboardYear) {
                $replyDate = new DateTime($row['replyDate']);
                return $replyDate->format('Y') == $adminDashboardYear;
            });  
            $filteredResultsCalendar = array_filter($calendarResults, function ($row) use ($adminDashboardYear) {
                $calendarDate = new DateTime($row['date']);
                return $calendarDate->format('Y') == $adminDashboardYear;
            });        
            $filteredResultsContent = array_filter($contentResults, function ($row) use ($adminDashboardYear) {
                $contentDate = new DateTime($row['reportedOn']);
                return $contentDate->format('Y') == $adminDashboardYear;
            });
            $filteredResultsUser = array_filter($userResults, function ($row) use ($adminDashboardYear) {
                $userDate = new DateTime($row['reportedOn']);
                return $userDate->format('Y') == $adminDashboardYear;
            });     

            foreach ($filteredResultsAccounts as $row) {
                $religion = $row['religion'];
                $accountDate = new DateTime($row['accountDate']);
                $registrationMonth = $accountDate->format('n');
                
                if ($accountDate->format('Y') == $adminDashboardYear) {
                    switch ($religion) {
                        case 'Buddhism':
                            $registeredBuddhists++;
                            break;
                        case 'Christianity':
                            $registeredChristians++;
                            break;
                        case 'Hinduism':
                            $registeredHindus++;
                            break;
                        case 'Islam':
                            $registeredIslams++;
                            break;
                        case 'Judaism':
                            $registeredJews++;
                            break;
                        case 'Other Religions':
                            $registeredOtherReligions++;
                            break;
                        case 'Non-Religious':
                            $registeredNonReligious++;
                            break;
                    }

                    switch ($registrationMonth) {
                        case 1:
                            $januaryUsersCurrent++;
                            break;
                        case 2:
                            $februaryUsersCurrent++;
                            break;
                        case 3:
                            $marchUsersCurrent++;
                            break;
                        case 4:
                            $aprilUsersCurrent++;
                            break;
                        case 5:
                            $mayUsersCurrent++;
                            break;
                        case 6:
                            $juneUsersCurrent++;
                            break;
                        case 7:
                            $julyUsersCurrent++;
                            break;
                        case 8:
                            $augustUsersCurrent++;
                            break;
                        case 9:
                            $septemberUsersCurrent++;
                            break;
                        case 10:
                            $octoberUsersCurrent++;
                            break;
                        case 11:
                            $novemberUsersCurrent++;
                            break;
                        case 12:
                            $decemberUsersCurrent++;
                            break;
                    }
                } elseif ($accountDate->format('Y') == ($adminDashboardYear - 1)) {
                    switch ($registrationMonth) {
                        case 1:
                            $januaryUsersPrevious++;
                            break;
                        case 2:
                            $februaryUsersPrevious++;
                            break;
                        case 3:
                            $marchUsersPrevious++;
                            break;
                        case 4:
                            $aprilUsersPrevious++;
                            break;
                        case 5:
                            $mayUsersPrevious++;
                            break;
                        case 6:
                            $juneUsersPrevious++;
                            break;
                        case 7:
                            $julyUsersPrevious++;
                            break;
                        case 8:
                            $augustUsersPrevious++;
                            break;
                        case 9:
                            $septemberUsersPrevious++;
                            break;
                        case 10:
                            $octoberUsersPrevious++;
                            break;
                        case 11:
                            $novemberUsersPrevious++;
                            break;
                        case 12:
                            $decemberUsersPrevious++;
                            break;
                    }
                }
            }

            foreach ($filteredResultsUserActvity as $row) {
                $pointSource = $row['pointsource'];
                $datetime = new DateTime($row['datetime']);
                $userActivityMonth = $datetime->format('n');
                $accountid = $row['accountid'];

                $userActivityReligionStmt = $pdo->prepare("SELECT religion FROM accounts WHERE accountid = :accountid");
                $userActivityReligionStmt->bindParam(":accountid", $accountid, PDO::PARAM_STR);
                $userActivityReligionStmt->execute();
                $userActivityReligionResult = $userActivityReligionStmt->fetchColumn();
                
                if ($datetime->format('Y') == $adminDashboardYear) {
                    if(strpos($pointSource, "_country_") !== false || strpos($pointSource, "_pin_") !== false){
                        switch ($userActivityMonth) {
                            case 1:
                                $januaryUserActivityMap++;
                                break;
                            case 2:
                                $februaryUserActivityMap++;
                                break;
                            case 3:
                                $marchUserActivityMap++;
                                break;
                            case 4:
                                $aprilUserActivityMap++;
                                break;
                            case 5:
                                $mayUserActivityMap++;
                                break;
                            case 6:
                                $juneUserActivityMap++;
                                break;
                            case 7:
                                $julyUserActivityMap++;
                                break;
                            case 8:
                                $augustUserActivityMap++;
                                break;
                            case 9:
                                $septemberUserActivityMap++;
                                break;
                            case 10:
                                $octoberUserActivityMap++;
                                break;
                            case 11:
                                $novemberUserActivityMap++;
                                break;
                            case 12:
                                $decemberUserActivityMap++;
                                break;
                        }
                        switch ($userActivityReligionResult) {
                            case 'Buddhism':
                                $buddhismUserActivityMap++;
                                break;
                            case 'Christianity':
                                $christianityUserActivityMap++;
                                break;
                            case 'Hinduism':
                                $hinduismUserActivityMap++;
                                break;
                            case 'Islam':
                                $islamUserActivityMap++;
                                break;
                            case 'Judaism':
                                $judaismUserActivityMap++;
                                break;
                            case 'Other Religions':
                                $otherReligionsUserActivityMap++;
                                break;
                            case 'Non-Religious':
                                $nonReligiousUserActivityMap++;
                                break;
                        }                          
                    } else if (strpos($pointSource, "_lib_") !== false) {
                        switch ($userActivityMonth) {
                            case 1:
                                $januaryUserActivityLibrary++;
                                break;
                            case 2:
                                $februaryUserActivityLibrary++;
                                break;
                            case 3:
                                $marchUserActivityLibrary++;
                                break;
                            case 4:
                                $aprilUserActivityLibrary++;
                                break;
                            case 5:
                                $mayUserActivityLibrary++;
                                break;
                            case 6:
                                $juneUserActivityLibrary++;
                                break;
                            case 7:
                                $julyUserActivityLibrary++;
                                break;
                            case 8:
                                $augustUserActivityLibrary++;
                                break;
                            case 9:
                                $septemberUserActivityLibrary++;
                                break;
                            case 10:
                                $octoberUserActivityLibrary++;
                                break;
                            case 11:
                                $novemberUserActivityLibrary++;
                                break;
                            case 12:
                                $decemberUserActivityLibrary++;
                                break;
                        }  
                        switch ($userActivityReligionResult) {
                            case 'Buddhism':
                                $buddhismUserActivityLibrary++;
                                break;
                            case 'Christianity':
                                $christianityUserActivityLibrary++;
                                break;
                            case 'Hinduism':
                                $hinduismUserActivityLibrary++;
                                break;
                            case 'Islam':
                                $islamUserActivityLibrary++;
                                break;
                            case 'Judaism':
                                $judaismUserActivityLibrary++;
                                break;
                            case 'Other Religions':
                                $otherReligionsUserActivityLibrary++;
                                break;
                            case 'Non-Religious':
                                $nonReligiousUserActivityLibrary++;
                                break;
                        }                      
                    } else if (strpos($pointSource, "_cc_") !== false) {
                        switch ($userActivityMonth) {
                            case 1:
                                $januaryUserActivityCommunity++;
                                break;
                            case 2:
                                $februaryUserActivityCommunity++;
                                break;
                            case 3:
                                $marchUserActivityCommunity++;
                                break;
                            case 4:
                                $aprilUserActivityCommunity++;
                                break;
                            case 5:
                                $mayUserActivityCommunity++;
                                break;
                            case 6:
                                $juneUserActivityCommunity++;
                                break;
                            case 7:
                                $julyUserActivityCommunity++;
                                break;
                            case 8:
                                $augustUserActivityCommunity++;
                                break;
                            case 9:
                                $septemberUserActivityCommunity++;
                                break;
                            case 10:
                                $octoberUserActivityCommunity++;
                                break;
                            case 11:
                                $novemberUserActivityCommunity++;
                                break;
                            case 12:
                                $decemberUserActivityCommunity++;
                                break;
                        }
                        switch ($userActivityReligionResult) {
                            case 'Buddhism':
                                $buddhismUserActivityCommunity++;
                                break;
                            case 'Christianity':
                                $christianityUserActivityCommunity++;
                                break;
                            case 'Hinduism':
                                $hinduismUserActivityCommunity++;
                                break;
                            case 'Islam':
                                $islamUserActivityCommunity++;
                                break;
                            case 'Judaism':
                                $judaismUserActivityCommunity++;
                                break;
                            case 'Other Religions':
                                $otherReligionsUserActivityCommunity++;
                                break;
                            case 'Non-Religious':
                                $nonReligiousUserActivityCommunity++;
                                break;
                        }                        
                    }  else if (strpos($pointSource, "_forum_") !== false) {
                        switch ($userActivityMonth) {
                            case 1:
                                $januaryUserActivityForum++;
                                break;
                            case 2:
                                $februaryUserActivityForum++;
                                break;
                            case 3:
                                $marchUserActivityForum++;
                                break;
                            case 4:
                                $aprilUserActivityForum++;
                                break;
                            case 5:
                                $mayUserActivityForum++;
                                break;
                            case 6:
                                $juneUserActivityForum++;
                                break;
                            case 7:
                                $julyUserActivityForum++;
                                break;
                            case 8:
                                $augustUserActivityForum++;
                                break;
                            case 9:
                                $septemberUserActivityForum++;
                                break;
                            case 10:
                                $octoberUserActivityForum++;
                                break;
                            case 11:
                                $novemberUserActivityForum++;
                                break;
                            case 12:
                                $decemberUserActivityForum++;
                                break;
                        }       
                        switch ($userActivityReligionResult) {
                            case 'Buddhism':
                                $buddhismUserActivityForum++;
                                break;
                            case 'Christianity':
                                $christianityUserActivityForum++;
                                break;
                            case 'Hinduism':
                                $hinduismUserActivityForum++;
                                break;
                            case 'Islam':
                                $islamUserActivityForum++;
                                break;
                            case 'Judaism':
                                $judaismUserActivityForum++;
                                break;
                            case 'Other Religions':
                                $otherReligionsUserActivityForum++;
                                break;
                            case 'Non-Religious':
                                $nonReligiousUserActivityForum++;
                                break;
                        }                 
                    }  else if (strpos($pointSource, "_calendar_") !== false) {
                        switch ($userActivityMonth) {
                            case 1:
                                $januaryUserActivityCalendar++;
                                break;
                            case 2:
                                $februaryUserActivityCalendar++;
                                break;
                            case 3:
                                $marchUserActivityCalendar++;
                                break;
                            case 4:
                                $aprilUserActivityCalendar++;
                                break;
                            case 5:
                                $mayUserActivityCalendar++;
                                break;
                            case 6:
                                $juneUserActivityCalendar++;
                                break;
                            case 7:
                                $julyUserActivityCalendar++;
                                break;
                            case 8:
                                $augustUserActivityCalendar++;
                                break;
                            case 9:
                                $septemberUserActivityCalendar++;
                                break;
                            case 10:
                                $octoberUserActivityCalendar++;
                                break;
                            case 11:
                                $novemberUserActivityCalendar++;
                                break;
                            case 12:
                                $decemberUserActivityCalendar++;
                                break;
                        }  
                        switch ($userActivityReligionResult) {
                            case 'Buddhism':
                                $buddhismUserActivityCalendar++;
                                break;
                            case 'Christianity':
                                $christianityUserActivityCalendar++;
                                break;
                            case 'Hinduism':
                                $hinduismUserActivityCalendar++;
                                break;
                            case 'Islam':
                                $islamUserActivityCalendar++;
                                break;
                            case 'Judaism':
                                $judaismUserActivityCalendar++;
                                break;
                            case 'Other Religions':
                                $otherReligionsUserActivityCalendar++;
                                break;
                            case 'Non-Religious':
                                $nonReligiousUserActivityCalendar++;
                                break;
                        }                      
                    }             
                }
            }

            foreach ($filteredResultsContent as $row) {
                $reportedContentDate = new DateTime($row['reportedOn']);
                $reportMonth = $reportedContentDate->format('n');

                switch ($reportMonth) {
                    case 1:
                        $januaryReportedContent++;
                        break;
                    case 2:
                        $februaryReportedContent++;
                        break;
                    case 3:
                        $marchReportedContent++;
                        break;
                    case 4:
                        $aprilReportedContent++;
                        break;
                    case 5:
                        $mayReportedContent++;
                        break;
                    case 6:
                        $juneReportedContent++;
                        break;
                    case 7:
                        $julyReportedContent++;
                        break;
                    case 8:
                        $augustReportedContent++;
                        break;
                    case 9:
                        $septemberReportedContent++;
                        break;
                    case 10:
                        $octoberReportedContent++;
                        break;
                    case 11:
                        $novemberReportedContent++;
                        break;
                    case 12:
                        $decemberReportedContent++;
                        break;
                }   
            }

            foreach ($filteredResultsUser as $row) {
                $reportedUsersDate = new DateTime($row['reportedOn']);
                $reportMonth = $reportedUsersDate->format('n');

                switch ($reportMonth) {
                    case 1:
                        $januaryReportedUsers++;
                        break;
                    case 2:
                        $februaryReportedUsers++;
                        break;
                    case 3:
                        $marchReportedUsers++;
                        break;
                    case 4:
                        $aprilReportedUsers++;
                        break;
                    case 5:
                        $mayReportedUsers++;
                        break;
                    case 6:
                        $juneReportedUsers++;
                        break;
                    case 7:
                        $julyReportedUsers++;
                        break;
                    case 8:
                        $augustReportedUsers++;
                        break;
                    case 9:
                        $septemberReportedUsers++;
                        break;
                    case 10:
                        $octoberReportedUsers++;
                        break;
                    case 11:
                        $novemberReportedUsers++;
                        break;
                    case 12:
                        $decemberReportedUsers++;
                        break;
                }                
            }

            $dashboardData = [
                "newUsers" => count($filteredResultsAccounts),
                "online" => count($filteredResultsAccessLogActive),
                "visitors" => count($filteredResultsAccessLogGuest),
                "registeredUsers" => $accountsStmt->rowCount(),
    
                "bookmarks" => count($filteredResultsBookmarks),
                "communityUploads" => count($filteredResultsCommunity),
                "forumPosts" => count($filteredResultsTopics) + count($filteredResultsPosts) + count($filteredResultsReplies),
                "celebratedEvents" => count($filteredResultsCalendar),
    
                //users by religion
                "registeredBuddhists" => $registeredBuddhists,
                "registeredChristians" => $registeredChristians,
                "registeredHindus" => $registeredHindus,
                "registeredIslams" => $registeredIslams,
                "registeredJews" => $registeredJews,
                "registeredOtherReligions" => $registeredOtherReligions,
                "registeredNonReligious" => $registeredNonReligious,
    
                // Users by month (previous)
                "januaryUsersPrevious" => $januaryUsersPrevious,
                "februaryUsersPrevious" => $februaryUsersPrevious,
                "marchUsersPrevious" => $marchUsersPrevious,
                "aprilUsersPrevious" => $aprilUsersPrevious,
                "mayUsersPrevious" => $mayUsersPrevious,
                "juneUsersPrevious" => $juneUsersPrevious,
                "julyUsersPrevious" => $julyUsersPrevious,
                "augustUsersPrevious" => $augustUsersPrevious,
                "septemberUsersPrevious" => $septemberUsersPrevious,
                "octoberUsersPrevious" => $octoberUsersPrevious,
                "novemberUsersPrevious" => $novemberUsersPrevious,
                "decemberUsersPrevious" => $decemberUsersPrevious,

                // Users by month (current)
                "januaryUsersCurrent" => $januaryUsersCurrent,
                "februaryUsersCurrent" => $februaryUsersCurrent,
                "marchUsersCurrent" => $marchUsersCurrent,
                "aprilUsersCurrent" => $aprilUsersCurrent,
                "mayUsersCurrent" => $mayUsersCurrent,
                "juneUsersCurrent" => $juneUsersCurrent,
                "julyUsersCurrent" => $julyUsersCurrent,
                "augustUsersCurrent" => $augustUsersCurrent,
                "septemberUsersCurrent" => $septemberUsersCurrent,
                "octoberUsersCurrent" => $octoberUsersCurrent,
                "novemberUsersCurrent" => $novemberUsersCurrent,
                "decemberUsersCurrent" => $decemberUsersCurrent,

                //user activity map
                "januaryUserActivityMap" => $januaryUserActivityMap,
                "februaryUserActivityMap" => $februaryUserActivityMap,
                "marchUserActivityMap" => $marchUserActivityMap,
                "aprilUserActivityMap" => $aprilUserActivityMap,
                "mayUserActivityMap" => $mayUserActivityMap,
                "juneUserActivityMap" => $juneUserActivityMap,
                "julyUserActivityMap" => $julyUserActivityMap,
                "augustUserActivityMap" => $augustUserActivityMap,
                "septemberUserActivityMap" => $septemberUserActivityMap,
                "octoberUserActivityMap" => $octoberUserActivityMap,
                "novemberUserActivityMap" => $novemberUserActivityMap,
                "decemberUserActivityMap" => $decemberUserActivityMap,

                //user activity library
                "januaryUserActivityLibrary" => $januaryUserActivityLibrary,
                "februaryUserActivityLibrary" => $februaryUserActivityLibrary,
                "marchUserActivityLibrary" => $marchUserActivityLibrary,
                "aprilUserActivityLibrary" => $aprilUserActivityLibrary,
                "mayUserActivityLibrary" => $mayUserActivityLibrary,
                "juneUserActivityLibrary" => $juneUserActivityLibrary,
                "julyUserActivityLibrary" => $julyUserActivityLibrary,
                "augustUserActivityLibrary" => $augustUserActivityLibrary,
                "septemberUserActivityLibrary" => $septemberUserActivityLibrary,
                "octoberUserActivityLibrary" => $octoberUserActivityLibrary,
                "novemberUserActivityLibrary" => $novemberUserActivityLibrary,
                "decemberUserActivityLibrary" => $decemberUserActivityLibrary,

                //user activity community
                "januaryUserActivityCommunity" => $januaryUserActivityCommunity,
                "februaryUserActivityCommunity" => $februaryUserActivityCommunity,
                "marchUserActivityCommunity" => $marchUserActivityCommunity,
                "aprilUserActivityCommunity" => $aprilUserActivityCommunity,
                "mayUserActivityCommunity" => $mayUserActivityCommunity,
                "juneUserActivityCommunity" => $juneUserActivityCommunity,
                "julyUserActivityCommunity" => $julyUserActivityCommunity,
                "augustUserActivityCommunity" => $augustUserActivityCommunity,
                "septemberUserActivityCommunity" => $septemberUserActivityCommunity,
                "octoberUserActivityCommunity" => $octoberUserActivityCommunity,
                "novemberUserActivityCommunity" => $novemberUserActivityCommunity,
                "decemberUserActivityCommunity" => $decemberUserActivityCommunity,

                //user activity forum
                "januaryUserActivityForum" => $januaryUserActivityForum,
                "februaryUserActivityForum" => $februaryUserActivityForum,
                "marchUserActivityForum" => $marchUserActivityForum,
                "aprilUserActivityForum" => $aprilUserActivityForum,
                "mayUserActivityForum" => $mayUserActivityForum,
                "juneUserActivityForum" => $juneUserActivityForum,
                "julyUserActivityForum" => $julyUserActivityForum,
                "augustUserActivityForum" => $augustUserActivityForum,
                "septemberUserActivityForum" => $septemberUserActivityForum,
                "octoberUserActivityForum" => $octoberUserActivityForum,
                "novemberUserActivityForum" => $novemberUserActivityForum,
                "decemberUserActivityForum" => $decemberUserActivityForum,

                //user activity calendar
                "januaryUserActivityCalendar" => $januaryUserActivityCalendar,
                "februaryUserActivityCalendar" => $februaryUserActivityCalendar,
                "marchUserActivityCalendar" => $marchUserActivityCalendar,
                "aprilUserActivityCalendar" => $aprilUserActivityCalendar,
                "mayUserActivityCalendar" => $mayUserActivityCalendar,
                "juneUserActivityCalendar" => $juneUserActivityCalendar,
                "julyUserActivityCalendar" => $julyUserActivityCalendar,
                "augustUserActivityCalendar" => $augustUserActivityCalendar,
                "septemberUserActivityCalendar" => $septemberUserActivityCalendar,
                "octoberUserActivityCalendar" => $octoberUserActivityCalendar,
                "novemberUserActivityCalendar" => $novemberUserActivityCalendar,
                "decemberUserActivityCalendar" => $decemberUserActivityCalendar,

                // Map
                "buddhismUserActivityMap" => $buddhismUserActivityMap,
                "christianityUserActivityMap" => $christianityUserActivityMap,
                "hinduismUserActivityMap" => $hinduismUserActivityMap,
                "islamUserActivityMap" => $islamUserActivityMap,
                "judaismUserActivityMap" => $judaismUserActivityMap,
                "otherReligionsUserActivityMap" => $otherReligionsUserActivityMap,
                "nonReligiousUserActivityMap" => $nonReligiousUserActivityMap,

                // Library
                "buddhismUserActivityLibrary" => $buddhismUserActivityLibrary,
                "christianityUserActivityLibrary" => $christianityUserActivityLibrary,
                "hinduismUserActivityLibrary" => $hinduismUserActivityLibrary,
                "islamUserActivityLibrary" => $islamUserActivityLibrary,
                "judaismUserActivityLibrary" => $judaismUserActivityLibrary,
                "otherReligionsUserActivityLibrary" => $otherReligionsUserActivityLibrary,
                "nonReligiousUserActivityLibrary" => $nonReligiousUserActivityLibrary,

                // Community
                "buddhismUserActivityCommunity" => $buddhismUserActivityCommunity,
                "christianityUserActivityCommunity" => $christianityUserActivityCommunity,
                "hinduismUserActivityCommunity" => $hinduismUserActivityCommunity,
                "islamUserActivityCommunity" => $islamUserActivityCommunity,
                "judaismUserActivityCommunity" => $judaismUserActivityCommunity,
                "otherReligionsUserActivityCommunity" => $otherReligionsUserActivityCommunity,
                "nonReligiousUserActivityCommunity" => $nonReligiousUserActivityCommunity,

                // Forum
                "buddhismUserActivityForum" => $buddhismUserActivityForum,
                "christianityUserActivityForum" => $christianityUserActivityForum,
                "hinduismUserActivityForum" => $hinduismUserActivityForum,
                "islamUserActivityForum" => $islamUserActivityForum,
                "judaismUserActivityForum" => $judaismUserActivityForum,
                "otherReligionsUserActivityForum" => $otherReligionsUserActivityForum,
                "nonReligiousUserActivityForum" => $nonReligiousUserActivityForum,

                // Calendar
                "buddhismUserActivityCalendar" => $buddhismUserActivityCalendar,
                "christianityUserActivityCalendar" => $christianityUserActivityCalendar,
                "hinduismUserActivityCalendar" => $hinduismUserActivityCalendar,
                "islamUserActivityCalendar" => $islamUserActivityCalendar,
                "judaismUserActivityCalendar" => $judaismUserActivityCalendar,
                "otherReligionsUserActivityCalendar" => $otherReligionsUserActivityCalendar,
                "nonReligiousUserActivityCalendar" => $nonReligiousUserActivityCalendar,

                //reported content
                "januaryReportedContent" => $januaryReportedContent,
                "februaryReportedContent" => $februaryReportedContent,
                "marchReportedContent" => $marchReportedContent,
                "aprilReportedContent" => $aprilReportedContent,
                "mayReportedContent" => $mayReportedContent,
                "juneReportedContent" => $juneReportedContent,
                "julyReportedContent" => $julyReportedContent,
                "augustReportedContent" => $augustReportedContent,
                "septemberReportedContent" => $septemberReportedContent,
                "octoberReportedContent" => $octoberReportedContent,
                "novemberReportedContent" => $novemberReportedContent,
                "decemberReportedContent" => $decemberReportedContent,

                //reported users
                "januaryReportedUsers" => $januaryReportedUsers,
                "februaryReportedUsers" => $februaryReportedUsers,
                "marchReportedUsers" => $marchReportedUsers,
                "aprilReportedUsers" => $aprilReportedUsers,
                "mayReportedUsers" => $mayReportedUsers,
                "juneReportedUsers" => $juneReportedUsers,
                "julyReportedUsers" => $julyReportedUsers,
                "augustReportedUsers" => $augustReportedUsers,
                "septemberReportedUsers" => $septemberReportedUsers,
                "octoberReportedUsers" => $octoberReportedUsers,
                "novemberReportedUsers" => $novemberReportedUsers,
                "decemberReportedUsers" => $decemberReportedUsers
            ];
        }

        
        
        $jsonData = json_encode($dashboardData);
        header('Content-Type: application/json');
        echo $jsonData;
    }     

}

?>