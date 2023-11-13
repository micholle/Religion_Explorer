$(function() {
    $.ajax({
        url: "../../ajax/showAdminSidebar.ajax.php",
        method: "POST",
        success:function(data){
            $("#dashboardSidebar").html(data);
            var currentPage = window.location.pathname.split("/").pop();

            $("#dashboardSidebar li a").each(function() {
                var tabPage = $(this).attr("href");
                if (tabPage === currentPage) {
                   $(this).addClass("active");
                }
            });
        }
    });

    $("#adminDashboardMonth").on("change", function() {
        var selectedMonth = $(this).val();
        if (selectedMonth == "allMonths") {
            $("#adminDashboardWeek").val("allWeeks");
            $("#adminDashboardWeek").prop("disabled", true);
        } else {
            $("#adminDashboardWeek").prop("disabled", false);

        }
    });

    var adminDashboardMonth = $("#adminDashboardMonth").val();
    var adminDashboardWeek= $("#adminDashboardWeek").val();
    var adminDashboardYear = $("#adminDashboardYear").val();

    var dashboardDate = new FormData();
    dashboardDate.append("adminDashboardMonth", adminDashboardMonth);
    dashboardDate.append("adminDashboardWeek", adminDashboardWeek);
    dashboardDate.append("adminDashboardYear", adminDashboardYear);

    $.ajax({
        url: "../../ajax/getDashboardData.ajax.php",
        method: "POST",
        data: dashboardDate,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (data) {
            var dashboardData = data;
    
            var newUsers = dashboardData.newUsers;
            var online = dashboardData.online;
            var visitors = dashboardData.visitors;
            var registeredUsers = dashboardData.registeredUsers;
        
            $("#newUsers").text(newUsers);
            $("#online").text(online);
            $("#visitors").text(visitors);
            $("#registeredUsers").text(registeredUsers);

            var bookmarks = dashboardData.bookmarks;
            var communityUploads = dashboardData.communityUploads;
            var forumPosts = dashboardData.forumPosts;
            var celebratedEvents = dashboardData.celebratedEvents;
        
            $("#bookmarks").text(bookmarks);
            $("#communityUploads").text(communityUploads);
            $("#forumPosts").text(forumPosts);
            $("#celebratedEvents").text(celebratedEvents);

            Chart.defaults.font.family = "Lexend";

            // Monthly New Users (2022)
            var januaryUsersPrevious = dashboardData.januaryUsersPrevious;
            var februaryUsersPrevious = dashboardData.februaryUsersPrevious;
            var marchUsersPrevious = dashboardData.marchUsersPrevious;
            var aprilUsersPrevious = dashboardData.aprilUsersPrevious;
            var mayUsersPrevious = dashboardData.mayUsersPrevious;
            var juneUsersPrevious = dashboardData.juneUsersPrevious;
            var julyUsersPrevious = dashboardData.julyUsersPrevious;
            var augustUsersPrevious = dashboardData.augustUsersPrevious;
            var septemberUsersPrevious = dashboardData.septemberUsersPrevious;
            var octoberUsersPrevious = dashboardData.octoberUsersPrevious;
            var novemberUsersPrevious = dashboardData.novemberUsersPrevious;
            var decemberUsersPrevious = dashboardData.decemberUsersPrevious;

            //Monthly New Users (2023)
            var januaryUsersCurrent = dashboardData.januaryUsersCurrent;
            var februaryUsersCurrent = dashboardData.februaryUsersCurrent;
            var marchUsersCurrent = dashboardData.marchUsersCurrent;
            var aprilUsersCurrent = dashboardData.aprilUsersCurrent;
            var mayUsersCurrent = dashboardData.mayUsersCurrent;
            var juneUsersCurrent = dashboardData.juneUsersCurrent;
            var julyUsersCurrent = dashboardData.julyUsersCurrent;
            var augustUsersCurrent = dashboardData.augustUsersCurrent;
            var septemberUsersCurrent = dashboardData.septemberUsersCurrent;
            var octoberUsersCurrent = dashboardData.octoberUsersCurrent;
            var novemberUsersCurrent = dashboardData.novemberUsersCurrent;
            var decemberUsersCurrent = dashboardData.decemberUsersCurrent;

            const monthlyUsersLabels = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
            
            const monthlyUsersData = {
                labels: monthlyUsersLabels,
                datasets: [
                    {
                        label: 'Monthly Active Users (' + (adminDashboardYear - 1) + ')',
                        data: [januaryUsersPrevious, februaryUsersPrevious, marchUsersPrevious, aprilUsersPrevious, mayUsersPrevious, juneUsersPrevious, julyUsersPrevious, augustUsersPrevious, septemberUsersPrevious, octoberUsersPrevious, novemberUsersPrevious, decemberUsersPrevious],
                        borderColor: "#3B97D3",
                        backgroundColor: "#3B97D3"
                    },
                    {
                        label: 'Monthly Active Users (' + adminDashboardYear + ')',
                        data: [januaryUsersCurrent, februaryUsersCurrent, marchUsersCurrent, aprilUsersCurrent, mayUsersCurrent, juneUsersCurrent, julyUsersCurrent, augustUsersCurrent, septemberUsersCurrent, octoberUsersCurrent, novemberUsersCurrent, decemberUsersCurrent],
                        borderColor: "#e56353",
                        backgroundColor: "#e56353"
                    }
                ]
            };
            
            const monthlyUsersConfig = {
                type: 'line',
                data: monthlyUsersData,
                options: {
                    responsive: true,
                    plugins: {
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: 'Monthly Active Users'
                    }
                    }
                },
            };
        
            const monthlyUsersCanvasElement = document.createElement('canvas');
            monthlyUsersCanvasElement.id = 'monthlyNewUsers';
        
            const monthlyUsersCanvasContainer = document.getElementById('monthlyNewUsersContainer');
            monthlyUsersCanvasContainer.appendChild(monthlyUsersCanvasElement);
            
            const monthlyUsersCtx = document.getElementById('monthlyNewUsers').getContext('2d');
            new Chart(monthlyUsersCtx, monthlyUsersConfig);

        
            //Registered Users
            var registeredBuddhists = dashboardData.registeredBuddhists;
            var registeredChristians = dashboardData.registeredChristians;
            var registeredHindus = dashboardData.registeredHindus;
            var registeredIslams = dashboardData.registeredIslams;
            var registeredJews = dashboardData.registeredJews;
            var registeredOtherReligions = dashboardData.registeredOtherReligions;
            var registeredNonReligious = dashboardData.registeredNonReligious;
        
            const registeredUsersLabels = ['Buddhism', 'Christianity', 'Hinduism', 'Islam', 'Judaism', 'Other Religions', 'Non-Religious'];
        
            const registeredUsersData = {
                labels: registeredUsersLabels,
                datasets: [{
                    label: 'Registered Users per Religion',
                    data: [registeredBuddhists, registeredChristians, registeredHindus, registeredIslams, registeredJews, registeredOtherReligions, registeredNonReligious],
                    backgroundColor: [
                        'rgba(186, 164, 0, 0.2)',
                        'rgba(86, 9, 122, 0.2)',
                        'rgba(168, 19, 21, 0.2)',
                        'rgba(1, 135, 68, 0.2)',
                        'rgba(19, 52, 168, 0.2)',
                        'rgba(179, 113, 0, 0.2)',
                        'rgba(36, 36, 36, 0.2)'
                    ],
                    borderColor: [
                        'rgb(186, 164, 0)',
                        'rgb(86, 9, 122)',
                        'rgb(168, 19, 21)',
                        'rgb(1, 135, 68)',
                        'rgb(19, 52, 168)',
                        'rgb(179, 113, 0)',
                        'rgb(36, 36, 36)'
                    ],
                    borderWidth: 1
                }]
            };
            
            const usersReligionConfig = {
                type: 'pie',
                data: registeredUsersData,
                options: {
                    responsive: true,
                    plugins: {
                      legend: {
                        position: 'top',
                      },
                      title: {
                        display: true,
                        text: 'Registered Users per Religion'
                      }
                    }
                },
            };
            
            const usersReligionCanvasElement = document.createElement('canvas');
            usersReligionCanvasElement.id = 'registeredUsersReligion';
            document.getElementById('registeredUsersReligionContainer').appendChild(usersReligionCanvasElement);

            const usersReligionCtx = document.getElementById('registeredUsersReligion').getContext('2d');
            new Chart(usersReligionCtx, usersReligionConfig);

            // Map
            var buddhismUserActivityMap = dashboardData.buddhismUserActivityMap;
            var christianityUserActivityMap = dashboardData.christianityUserActivityMap;
            var hinduismUserActivityMap = dashboardData.hinduismUserActivityMap;
            var islamUserActivityMap = dashboardData.islamUserActivityMap;
            var judaismUserActivityMap = dashboardData.judaismUserActivityMap;
            var otherReligionsUserActivityMap = dashboardData.otherReligionsUserActivityMap;
            var nonReligiousUserActivityMap = dashboardData.nonReligiousUserActivityMap;

            // Library
            var buddhismUserActivityLibrary = dashboardData.buddhismUserActivityLibrary;
            var christianityUserActivityLibrary = dashboardData.christianityUserActivityLibrary;
            var hinduismUserActivityLibrary = dashboardData.hinduismUserActivityLibrary;
            var islamUserActivityLibrary = dashboardData.islamUserActivityLibrary;
            var judaismUserActivityLibrary = dashboardData.judaismUserActivityLibrary;
            var otherReligionsUserActivityLibrary = dashboardData.otherReligionsUserActivityLibrary;
            var nonReligiousUserActivityLibrary = dashboardData.nonReligiousUserActivityLibrary;

            // Community
            var buddhismUserActivityCommunity = dashboardData.buddhismUserActivityCommunity;
            var christianityUserActivityCommunity = dashboardData.christianityUserActivityCommunity;
            var hinduismUserActivityCommunity = dashboardData.hinduismUserActivityCommunity;
            var islamUserActivityCommunity = dashboardData.islamUserActivityCommunity;
            var judaismUserActivityCommunity = dashboardData.judaismUserActivityCommunity;
            var otherReligionsUserActivityCommunity = dashboardData.otherReligionsUserActivityCommunity;
            var nonReligiousUserActivityCommunity = dashboardData.nonReligiousUserActivityCommunity;

            // Forum
            var buddhismUserActivityForum = dashboardData.buddhismUserActivityForum;
            var christianityUserActivityForum = dashboardData.christianityUserActivityForum;
            var hinduismUserActivityForum = dashboardData.hinduismUserActivityForum;
            var islamUserActivityForum = dashboardData.islamUserActivityForum;
            var judaismUserActivityForum = dashboardData.judaismUserActivityForum;
            var otherReligionsUserActivityForum = dashboardData.otherReligionsUserActivityForum;
            var nonReligiousUserActivityForum = dashboardData.nonReligiousUserActivityForum;

            // Calendar
            var buddhismUserActivityCalendar = dashboardData.buddhismUserActivityCalendar;
            var christianityUserActivityCalendar = dashboardData.christianityUserActivityCalendar;
            var hinduismUserActivityCalendar = dashboardData.hinduismUserActivityCalendar;
            var islamUserActivityCalendar = dashboardData.islamUserActivityCalendar;
            var judaismUserActivityCalendar = dashboardData.judaismUserActivityCalendar;
            var otherReligionsUserActivityCalendar = dashboardData.otherReligionsUserActivityCalendar;
            var nonReligiousUserActivityCalendar = dashboardData.nonReligiousUserActivityCalendar;
        
            const usersActivityReligionLabels = ['Buddhism', 'Christianity', 'Hinduism', 'Islam', 'Judaism', 'Other Religions', 'Non-Religious'];
        
            const usersActivityReligionData = {
                labels: usersActivityReligionLabels,
                datasets: [
                    {
                        label: 'Map',
                        data: [buddhismUserActivityMap, christianityUserActivityMap, hinduismUserActivityMap, islamUserActivityMap, judaismUserActivityMap, otherReligionsUserActivityMap, nonReligiousUserActivityMap],
                        backgroundColor: ['rgba(186, 164, 0, 0.2)'],
                        borderColor: ['rgb(186, 164, 0)'],
                        borderWidth: 1
                    },
                    {
                        label: 'Library',
                        data: [buddhismUserActivityLibrary, christianityUserActivityLibrary, hinduismUserActivityLibrary, islamUserActivityLibrary, judaismUserActivityLibrary, otherReligionsUserActivityLibrary, nonReligiousUserActivityLibrary],
                        backgroundColor: ['rgba(86, 9, 122, 0.2)'],
                        borderColor: ['rgb(86, 9, 122)'],
                        borderWidth: 1
                    },
                    {
                        label: 'CommunityCreations',
                        data: [buddhismUserActivityCommunity, christianityUserActivityCommunity, hinduismUserActivityCommunity, islamUserActivityCommunity, judaismUserActivityCommunity, otherReligionsUserActivityCommunity, nonReligiousUserActivityCommunity],
                        backgroundColor: ['rgba(168, 19, 21, 0.2)'],
                        borderColor: ['rgb(168, 19, 21)'],
                        borderWidth: 1
                    },
                    {
                        label: 'Discussion Forum',
                        data: [buddhismUserActivityForum, christianityUserActivityForum, hinduismUserActivityForum, islamUserActivityForum, judaismUserActivityForum, otherReligionsUserActivityForum, nonReligiousUserActivityForum],
                        backgroundColor: ['rgba(1, 135, 68, 0.2)'],
                        borderColor: ['rgb(1, 135, 68)'],
                        borderWidth: 1
                    },
                    {
                        label: 'Calendar',
                        data: [buddhismUserActivityCalendar, christianityUserActivityCalendar, hinduismUserActivityCalendar, islamUserActivityCalendar, judaismUserActivityCalendar, otherReligionsUserActivityCalendar, nonReligiousUserActivityCalendar],
                        backgroundColor: ['rgba(19, 52, 168, 0.2)'],
                        borderColor: ['rgb(19, 52, 168)'],
                        borderWidth: 1
                    }
            ]
            };
            const usersActivityReligionConfig = {
                type: 'bar',
                data: usersActivityReligionData,
                options: {
                  indexAxis: 'y',
                  plugins: {
                    title: {
                      display: true,
                      text: 'User Activity per Religion'
                    },
                  },
                  responsive: true,
                  scales: {
                    x: {
                      stacked: true,
                    },
                    y: {
                      stacked: true
                    }
                  }
                }
            };

            const usersActivityReligionCanvasElement = document.createElement('canvas');
            usersActivityReligionCanvasElement.id = 'usersActivityReligion';
            document.getElementById('usersActivityReligionContainer').appendChild(usersActivityReligionCanvasElement);
            
            const usersActivityReligionCanvasCtx = document.getElementById('usersActivityReligion').getContext('2d');
            new Chart(usersActivityReligionCanvasCtx, usersActivityReligionConfig);

            //user activity map
            var januaryUserActivityMap = dashboardData.januaryUserActivityMap;
            var februaryUserActivityMap = dashboardData.februaryUserActivityMap;
            var marchUserActivityMap = dashboardData.marchUserActivityMap;
            var aprilUserActivityMap = dashboardData.aprilUserActivityMap;
            var mayUserActivityMap = dashboardData.mayUserActivityMap;
            var juneUserActivityMap = dashboardData.juneUserActivityMap;
            var julyUserActivityMap = dashboardData.julyUserActivityMap;
            var augustUserActivityMap = dashboardData.augustUserActivityMap;
            var septemberUserActivityMap = dashboardData.septemberUserActivityMap;
            var octoberUserActivityMap = dashboardData.octoberUserActivityMap;
            var novemberUserActivityMap = dashboardData.novemberUserActivityMap;
            var decemberUserActivityMap = dashboardData.decemberUserActivityMap;

            // user activity library
            var januaryUserActivityLibrary = dashboardData.januaryUserActivityLibrary;
            var februaryUserActivityLibrary = dashboardData.februaryUserActivityLibrary;
            var marchUserActivityLibrary = dashboardData.marchUserActivityLibrary;
            var aprilUserActivityLibrary = dashboardData.aprilUserActivityLibrary;
            var mayUserActivityLibrary = dashboardData.mayUserActivityLibrary;
            var juneUserActivityLibrary = dashboardData.juneUserActivityLibrary;
            var julyUserActivityLibrary = dashboardData.julyUserActivityLibrary;
            var augustUserActivityLibrary = dashboardData.augustUserActivityLibrary;
            var septemberUserActivityLibrary = dashboardData.septemberUserActivityLibrary;
            var octoberUserActivityLibrary = dashboardData.octoberUserActivityLibrary;
            var novemberUserActivityLibrary = dashboardData.novemberUserActivityLibrary;
            var decemberUserActivityLibrary = dashboardData.decemberUserActivityLibrary;

            // user acitivity community
            var januaryUserActivityCommunity = dashboardData.januaryUserActivityCommunity;
            var februaryUserActivityCommunity = dashboardData.februaryUserActivityCommunity;
            var marchUserActivityCommunity = dashboardData.marchUserActivityCommunity;
            var aprilUserActivityCommunity = dashboardData.aprilUserActivityCommunity;
            var mayUserActivityCommunity = dashboardData.mayUserActivityCommunity;
            var juneUserActivityCommunity = dashboardData.juneUserActivityCommunity;
            var julyUserActivityCommunity = dashboardData.julyUserActivityCommunity;
            var augustUserActivityCommunity = dashboardData.augustUserActivityCommunity;
            var septemberUserActivityCommunity = dashboardData.septemberUserActivityCommunity;
            var octoberUserActivityCommunity = dashboardData.octoberUserActivityCommunity;
            var novemberUserActivityCommunity = dashboardData.novemberUserActivityCommunity;
            var decemberUserActivityCommunity = dashboardData.decemberUserActivityCommunity;

            // user activity forum
            var januaryUserActivityForum = dashboardData.januaryUserActivityForum;
            var februaryUserActivityForum = dashboardData.februaryUserActivityForum;
            var marchUserActivityForum = dashboardData.marchUserActivityForum;
            var aprilUserActivityForum = dashboardData.aprilUserActivityForum;
            var mayUserActivityForum = dashboardData.mayUserActivityForum;
            var juneUserActivityForum = dashboardData.juneUserActivityForum;
            var julyUserActivityForum = dashboardData.julyUserActivityForum;
            var augustUserActivityForum = dashboardData.augustUserActivityForum;
            var septemberUserActivityForum = dashboardData.septemberUserActivityForum;
            var octoberUserActivityForum = dashboardData.octoberUserActivityForum;
            var novemberUserActivityForum = dashboardData.novemberUserActivityForum;
            var decemberUserActivityForum = dashboardData.decemberUserActivityForum;

            // user activity calendar
            var januaryUserActivityCalendar = dashboardData.januaryUserActivityCalendar;
            var februaryUserActivityCalendar = dashboardData.februaryUserActivityCalendar;
            var marchUserActivityCalendar = dashboardData.marchUserActivityCalendar;
            var aprilUserActivityCalendar = dashboardData.aprilUserActivityCalendar;
            var mayUserActivityCalendar = dashboardData.mayUserActivityCalendar;
            var juneUserActivityCalendar = dashboardData.juneUserActivityCalendar;
            var julyUserActivityCalendar = dashboardData.julyUserActivityCalendar;
            var augustUserActivityCalendar = dashboardData.augustUserActivityCalendar;
            var septemberUserActivityCalendar = dashboardData.septemberUserActivityCalendar;
            var octoberUserActivityCalendar = dashboardData.octoberUserActivityCalendar;
            var novemberUserActivityCalendar = dashboardData.novemberUserActivityCalendar;
            var decemberUserActivityCalendar = dashboardData.decemberUserActivityCalendar;
        
            const usersActivityLabels = ["01", "02", "03", "04", "05", "06", "07", "08", "09", "10", "11", "12"];
        
            const usersActivityData = {
                labels: usersActivityLabels,
                datasets: [
                    {
                        label: 'Map',
                        data: [januaryUserActivityMap, februaryUserActivityMap, marchUserActivityMap, aprilUserActivityMap, mayUserActivityMap, juneUserActivityMap, julyUserActivityMap, augustUserActivityMap, septemberUserActivityMap, octoberUserActivityMap, novemberUserActivityMap, decemberUserActivityMap],
                        backgroundColor: ['rgba(186, 164, 0, 0.2)'],
                        borderColor: ['rgb(186, 164, 0)'],
                        borderWidth: 1
                    },
                    {
                        label: 'Library',
                        data: [januaryUserActivityLibrary, februaryUserActivityLibrary, marchUserActivityLibrary, aprilUserActivityLibrary, mayUserActivityLibrary, juneUserActivityLibrary, julyUserActivityLibrary, augustUserActivityLibrary, septemberUserActivityLibrary, octoberUserActivityLibrary, novemberUserActivityLibrary, decemberUserActivityLibrary],                        
                        backgroundColor: ['rgba(86, 9, 122, 0.2)'],
                        borderColor: ['rgb(86, 9, 122)'],
                        borderWidth: 1
                    },
                    {
                        label: 'CommunityCreations',
                        data: [januaryUserActivityCommunity, februaryUserActivityCommunity, marchUserActivityCommunity, aprilUserActivityCommunity, mayUserActivityCommunity, juneUserActivityCommunity, julyUserActivityCommunity, augustUserActivityCommunity, septemberUserActivityCommunity, octoberUserActivityCommunity, novemberUserActivityCommunity, decemberUserActivityCommunity],
                        backgroundColor: ['rgba(168, 19, 21, 0.2)'],
                        borderColor: ['rgb(168, 19, 21)'],
                        borderWidth: 1
                    },
                    {
                        label: 'Discussion Forum',
                        data: [januaryUserActivityForum, februaryUserActivityForum, marchUserActivityForum, aprilUserActivityForum, mayUserActivityForum, juneUserActivityForum, julyUserActivityForum, augustUserActivityForum, septemberUserActivityForum, octoberUserActivityForum, novemberUserActivityForum, decemberUserActivityForum],
                        backgroundColor: ['rgba(1, 135, 68, 0.2)'],
                        borderColor: ['rgb(1, 135, 68)'],
                        borderWidth: 1
                    },
                    {
                        label: 'Calendar',
                        data: [januaryUserActivityCalendar, februaryUserActivityCalendar, marchUserActivityCalendar, aprilUserActivityCalendar, mayUserActivityCalendar, juneUserActivityCalendar, julyUserActivityCalendar, augustUserActivityCalendar, septemberUserActivityCalendar, octoberUserActivityCalendar, novemberUserActivityCalendar, decemberUserActivityCalendar],
                        backgroundColor: ['rgba(19, 52, 168, 0.2)'],
                        borderColor: ['rgb(19, 52, 168)'],
                        borderWidth: 1
                    }
            ]
            };
            const usersActivityConfig = {
                type: 'bar',
                data: usersActivityData,
                options: {
                //   indexAxis: 'y',
                  plugins: {
                    title: {
                      display: true,
                      text: 'Monthly User Activity'
                    },
                  },
                  responsive: true,
                  scales: {
                    x: {
                      stacked: true,
                    },
                    y: {
                      stacked: true
                    }
                  }
                }
            };

            const usersActivityCanvasElement = document.createElement('canvas');
            usersActivityCanvasElement.id = 'usersActivity';
            document.getElementById('usersActivityContainer').appendChild(usersActivityCanvasElement);
            
            const usersActivityCanvasCtx = document.getElementById('usersActivity').getContext('2d');
            new Chart(usersActivityCanvasCtx, usersActivityConfig);

            // Reported Content
            var januaryReportedContent = dashboardData.januaryReportedContent;
            var februaryReportedContent = dashboardData.februaryReportedContent;
            var marchReportedContent = dashboardData.marchReportedContent;
            var aprilReportedContent = dashboardData.aprilReportedContent;
            var mayReportedContent = dashboardData.mayReportedContent;
            var juneReportedContent = dashboardData.juneReportedContent;
            var julyReportedContent = dashboardData.julyReportedContent;
            var augustReportedContent = dashboardData.augustReportedContent;
            var septemberReportedContent = dashboardData.septemberReportedContent;
            var octoberReportedContent = dashboardData.octoberReportedContent;
            var novemberReportedContent = dashboardData.novemberReportedContent;
            var decemberReportedContent = dashboardData.decemberReportedContent;            
        
            const reportedContentLabels = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
            
            const reportedContentData = {
                labels: reportedContentLabels,
                datasets: [
                    {
                        label: 'Reported Content Count',
                        data: [januaryReportedContent, februaryReportedContent, marchReportedContent, aprilReportedContent, mayReportedContent, juneReportedContent, julyReportedContent, augustReportedContent, septemberReportedContent, octoberReportedContent, novemberReportedContent, decemberReportedContent],
                        borderColor: "#2CA464",
                        backgroundColor: "#2CA464"
                    }
                ]
            };
            
            const reportedContentConfig = {
                type: 'bar',
                data: reportedContentData,
                options: {
                    responsive: true,
                    plugins: {
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: "Reported Content " + adminDashboardYear
                    }
                    }
                },
            };
        
            const reportedContentCanvasElement = document.createElement('canvas');
            reportedContentCanvasElement.id = 'reportedContent';
        
            const reportedContentCanvasContainer = document.getElementById('reportedContentContainer');
            reportedContentCanvasContainer.appendChild(reportedContentCanvasElement);
            
            const reportedContentCtx = document.getElementById('reportedContent').getContext('2d');
            new Chart(reportedContentCtx, reportedContentConfig);

            // Reported Users
            var januaryReportedUsers = dashboardData.januaryReportedUsers;
            var februaryReportedUsers = dashboardData.februaryReportedUsers;
            var marchReportedUsers = dashboardData.marchReportedUsers;
            var aprilReportedUsers = dashboardData.aprilReportedUsers;
            var mayReportedUsers = dashboardData.mayReportedUsers;
            var juneReportedUsers = dashboardData.juneReportedUsers;
            var julyReportedUsers = dashboardData.julyReportedUsers;
            var augustReportedUsers = dashboardData.augustReportedUsers;
            var septemberReportedUsers = dashboardData.septemberReportedUsers;
            var octoberReportedUsers = dashboardData.octoberReportedUsers;
            var novemberReportedUsers = dashboardData.novemberReportedUsers;
            var decemberReportedUsers = dashboardData.decemberReportedUsers;

        
            const reportedUsersLabels = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
            
            const reportedUsersData = {
                labels: reportedUsersLabels,
                datasets: [
                    {
                        label: 'Reported Users Count',
                        data: [januaryReportedUsers, februaryReportedUsers, marchReportedUsers, aprilReportedUsers, mayReportedUsers, juneReportedUsers, julyReportedUsers, augustReportedUsers, septemberReportedUsers, octoberReportedUsers, novemberReportedUsers, decemberReportedUsers],
                        borderColor: "#d5af4d",
                        backgroundColor: "#d5af4d"
                    }
                ]
            };
            
            const reportedUsersConfig = {
                type: 'bar',
                data: reportedUsersData,
                options: {
                    responsive: true,
                    plugins: {
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: "Reported Users " + adminDashboardYear
                    }
                    }
                },
            };
        
            const reportedUsersCanvasElement = document.createElement('canvas');
            reportedUsersCanvasElement.id = 'reportedUsers';
        
            const reportedUsersCanvasContainer = document.getElementById('reportedUsersContainer');
            reportedUsersCanvasContainer.appendChild(reportedUsersCanvasElement);
            
            const reportedUsersCtx = document.getElementById('reportedUsers').getContext('2d');
            new Chart(reportedUsersCtx, reportedUsersConfig);
        }
    });
    
});
