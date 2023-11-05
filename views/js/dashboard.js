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

    $.ajax({
        url: "../../ajax/getDashboardData.ajax.php",
        method: "POST",
        success: function (data) {
            var dashboardData = data;
    
            var todayNewUsers = dashboardData.todayNewUsers;
            var online = dashboardData.online;
            var visitors = dashboardData.visitors;
            var registeredUsers = dashboardData.registeredUsers;
        
            $("#todaysNewUsers").text(todayNewUsers);
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
            var januaryUsers2022 = dashboardData.januaryUsers2022;
            var februaryUsers2022 = dashboardData.februaryUsers2022;
            var marchUsers2022 = dashboardData.marchUsers2022;
            var aprilUsers2022 = dashboardData.aprilUsers2022;
            var mayUsers2022 = dashboardData.mayUsers2022;
            var juneUsers2022 = dashboardData.juneUsers2022;
            var julyUsers2022 = dashboardData.julyUsers2022;
            var augustUsers2022 = dashboardData.augustUsers2022;
            var septemberUsers2022 = dashboardData.septemberUsers2022;
            var octoberUsers2022 = dashboardData.octoberUsers2022;
            var novemberUsers2022 = dashboardData.novemberUsers2022;
            var decemberUsers2022 = dashboardData.decemberUsers2022;


            //Monthly New Users (2023)
            var januaryUsers2023 = dashboardData.januaryUsers2023;
            var februaryUsers2023 = dashboardData.februaryUsers2023;
            var marchUsers2023 = dashboardData.marchUsers2023;
            var aprilUsers2023 = dashboardData.aprilUsers2023;
            var mayUsers2023 = dashboardData.mayUsers2023;
            var juneUsers2023 = dashboardData.juneUsers2023;
            var julyUsers2023 = dashboardData.julyUsers2023;
            var augustUsers2023 = dashboardData.augustUsers2023;
            var septemberUsers2023 = dashboardData.septemberUsers2023;
            var octoberUsers2023 = dashboardData.octoberUsers2023;
            var novemberUsers2023 = dashboardData.novemberUsers2023;
            var decemberUsers2023 = dashboardData.decemberUsers2023;
        
            const monthlyUsersLabels = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
            
            const monthlyUsersData = {
                labels: monthlyUsersLabels,
                datasets: [
                    {
                        label: 'Monthly Active Users (2022)',
                        data: [januaryUsers2022, februaryUsers2022, marchUsers2022, aprilUsers2022, mayUsers2022, juneUsers2022, julyUsers2022, augustUsers2022, septemberUsers2022, octoberUsers2022, novemberUsers2022, decemberUsers2022],
                        borderColor: "#3B97D3",
                        backgroundColor: "#3B97D3"
                    },
                    {
                        label: 'Monthly Active Users (2023)',
                        data: [januaryUsers2023, februaryUsers2023, marchUsers2023, aprilUsers2023, mayUsers2023, juneUsers2023, julyUsers2023, augustUsers2023, septemberUsers2023, octoberUsers2023, novemberUsers2023, decemberUsers2023],
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

            //Users activity
            var registeredBuddhists = dashboardData.registeredBuddhists;
            var registeredChristians = dashboardData.registeredChristians;
            var registeredHindus = dashboardData.registeredHindus;
            var registeredIslams = dashboardData.registeredIslams;
            var registeredJews = dashboardData.registeredJews;
            var registeredOtherReligions = dashboardData.registeredOtherReligions;
            var registeredNonReligious = dashboardData.registeredNonReligious;
        
            const usersActivityReligionLabels = ['Buddhism', 'Christianity', 'Hinduism', 'Islam', 'Judaism', 'Other Religions', 'Non-Religious'];
        
            const usersActivityReligionData = {
                labels: usersActivityReligionLabels,
                datasets: [
                    {
                        label: 'Map',
                        data: [registeredBuddhists, registeredChristians, registeredHindus, registeredIslams, registeredJews, registeredOtherReligions, registeredNonReligious],
                        backgroundColor: ['rgba(186, 164, 0, 0.2)'],
                        borderColor: ['rgb(186, 164, 0)'],
                        borderWidth: 1
                    },
                    {
                        label: 'Library',
                        data: [registeredBuddhists, registeredChristians, registeredHindus, registeredIslams, registeredJews, registeredOtherReligions, registeredNonReligious],
                        backgroundColor: ['rgba(86, 9, 122, 0.2)'],
                        borderColor: ['rgb(86, 9, 122)'],
                        borderWidth: 1
                    },
                    {
                        label: 'CommunityCreations',
                        data: [registeredBuddhists, registeredChristians, registeredHindus, registeredIslams, registeredJews, registeredOtherReligions, registeredNonReligious],
                        backgroundColor: ['rgba(168, 19, 21, 0.2)'],
                        borderColor: ['rgb(168, 19, 21)'],
                        borderWidth: 1
                    },
                    {
                        label: 'Discussion Forum',
                        data: [registeredBuddhists, registeredChristians, registeredHindus, registeredIslams, registeredJews, registeredOtherReligions, registeredNonReligious],
                        backgroundColor: ['rgba(1, 135, 68, 0.2)'],
                        borderColor: ['rgb(1, 135, 68)'],
                        borderWidth: 1
                    },
                    {
                        label: 'Calendar',
                        data: [registeredBuddhists, registeredChristians, registeredHindus, registeredIslams, registeredJews, registeredOtherReligions, registeredNonReligious],
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

            //Users activity
            var januaryUsers2022 = dashboardData.januaryUsers2022;
            var februaryUsers2022 = dashboardData.februaryUsers2022;
            var marchUsers2022 = dashboardData.marchUsers2022;
            var aprilUsers2022 = dashboardData.aprilUsers2022;
            var mayUsers2022 = dashboardData.mayUsers2022;
            var juneUsers2022 = dashboardData.juneUsers2022;
            var julyUsers2022 = dashboardData.julyUsers2022;
            var augustUsers2022 = dashboardData.augustUsers2022;
            var septemberUsers2022 = dashboardData.septemberUsers2022;
            var octoberUsers2022 = dashboardData.octoberUsers2022;
            var novemberUsers2022 = dashboardData.novemberUsers2022;
            var decemberUsers2022 = dashboardData.decemberUsers2022;
        
            const usersActivityLabels = ["01", "02", "03", "04", "05", "06", "07", "08", "09", "10", "11", "12"];
        
            const usersActivityData = {
                labels: usersActivityLabels,
                datasets: [
                    {
                        label: 'Map',
                        data: [januaryUsers2022, februaryUsers2022, marchUsers2022, aprilUsers2022, mayUsers2022, juneUsers2022, julyUsers2022, augustUsers2022, septemberUsers2022, octoberUsers2022, novemberUsers2022, decemberUsers2022],
                        backgroundColor: ['rgba(186, 164, 0, 0.2)'],
                        borderColor: ['rgb(186, 164, 0)'],
                        borderWidth: 1
                    },
                    {
                        label: 'Library',
                        data: [januaryUsers2022, februaryUsers2022, marchUsers2022, aprilUsers2022, mayUsers2022, juneUsers2022, julyUsers2022, augustUsers2022, septemberUsers2022, octoberUsers2022, novemberUsers2022, decemberUsers2022],
                        backgroundColor: ['rgba(86, 9, 122, 0.2)'],
                        borderColor: ['rgb(86, 9, 122)'],
                        borderWidth: 1
                    },
                    {
                        label: 'CommunityCreations',
                        data: [januaryUsers2022, februaryUsers2022, marchUsers2022, aprilUsers2022, mayUsers2022, juneUsers2022, julyUsers2022, augustUsers2022, septemberUsers2022, octoberUsers2022, novemberUsers2022, decemberUsers2022],
                        backgroundColor: ['rgba(168, 19, 21, 0.2)'],
                        borderColor: ['rgb(168, 19, 21)'],
                        borderWidth: 1
                    },
                    {
                        label: 'Discussion Forum',
                        data: [januaryUsers2022, februaryUsers2022, marchUsers2022, aprilUsers2022, mayUsers2022, juneUsers2022, julyUsers2022, augustUsers2022, septemberUsers2022, octoberUsers2022, novemberUsers2022, decemberUsers2022],
                        backgroundColor: ['rgba(1, 135, 68, 0.2)'],
                        borderColor: ['rgb(1, 135, 68)'],
                        borderWidth: 1
                    },
                    {
                        label: 'Calendar',
                        data: [januaryUsers2022, februaryUsers2022, marchUsers2022, aprilUsers2022, mayUsers2022, juneUsers2022, julyUsers2022, augustUsers2022, septemberUsers2022, octoberUsers2022, novemberUsers2022, decemberUsers2022],
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
            var januaryUsers2022 = dashboardData.januaryUsers2022;
            var februaryUsers2022 = dashboardData.februaryUsers2022;
            var marchUsers2022 = dashboardData.marchUsers2022;
            var aprilUsers2022 = dashboardData.aprilUsers2022;
            var mayUsers2022 = dashboardData.mayUsers2022;
            var juneUsers2022 = dashboardData.juneUsers2022;
            var julyUsers2022 = dashboardData.julyUsers2022;
            var augustUsers2022 = dashboardData.augustUsers2022;
            var septemberUsers2022 = dashboardData.septemberUsers2022;
            var octoberUsers2022 = dashboardData.octoberUsers2022;
            var novemberUsers2022 = dashboardData.novemberUsers2022;
            var decemberUsers2022 = dashboardData.decemberUsers2022;
        
            const reportedContentLabels = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
            
            const reportedContentData = {
                labels: reportedContentLabels,
                datasets: [
                    {
                        label: 'Reported Content',
                        data: [januaryUsers2022, februaryUsers2022, marchUsers2022, aprilUsers2022, mayUsers2022, juneUsers2022, julyUsers2022, augustUsers2022, septemberUsers2022, octoberUsers2022, novemberUsers2022, decemberUsers2022],
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
                        text: "January to December 2023"
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
            var januaryUsers2022 = dashboardData.januaryUsers2022;
            var februaryUsers2022 = dashboardData.februaryUsers2022;
            var marchUsers2022 = dashboardData.marchUsers2022;
            var aprilUsers2022 = dashboardData.aprilUsers2022;
            var mayUsers2022 = dashboardData.mayUsers2022;
            var juneUsers2022 = dashboardData.juneUsers2022;
            var julyUsers2022 = dashboardData.julyUsers2022;
            var augustUsers2022 = dashboardData.augustUsers2022;
            var septemberUsers2022 = dashboardData.septemberUsers2022;
            var octoberUsers2022 = dashboardData.octoberUsers2022;
            var novemberUsers2022 = dashboardData.novemberUsers2022;
            var decemberUsers2022 = dashboardData.decemberUsers2022;
        
            const reportedUsersLabels = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
            
            const reportedUsersData = {
                labels: reportedUsersLabels,
                datasets: [
                    {
                        label: 'Reported Users',
                        data: [januaryUsers2022, februaryUsers2022, marchUsers2022, aprilUsers2022, mayUsers2022, juneUsers2022, julyUsers2022, augustUsers2022, septemberUsers2022, octoberUsers2022, novemberUsers2022, decemberUsers2022],
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
                        text: "January to December 2023"
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
