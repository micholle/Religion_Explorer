<?php
require_once "connection.php";

class dashboardModel {

    static public function mdlGetDashboardData($data) {
        $db = new Connection();
        $pdo = $db->connect();

        $adminDashboardYear = $data["adminDashboardYear"];
        $adminDashboardMonth = $data["adminDashboardMonth"];
        $adminDashboardWeek = $data["adminDashboardWeek"];
        
        $accountsStmt = $pdo->prepare("SELECT * FROM accounts");
        $accountsStmt->execute();
        $accountsResults = $accountsStmt->fetchAll(PDO::FETCH_ASSOC);

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

            $filteredResultsAccounts = array_filter($accountsResults, function ($row) use ($adminDashboardYear) {
                $accountDate = new DateTime($row['accountDate']);
                return $accountDate->format('Y') == $adminDashboardYear || $accountDate->format('Y') == ($adminDashboardYear - 1);
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
                "online" => 12,
                "visitors" => 27,
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