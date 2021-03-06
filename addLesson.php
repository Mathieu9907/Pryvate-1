<html>
    <head>
        <link rel="stylesheet" href="pryvate.css">
        <title>Add Private Lesson</title>
    </head>
    <body>
        <?php
            require_once('config.php');
            include 'addLessonFunc.php';

//add new lesson info
        ?>
        <h1>Add New Private Lesson</h1>
        <div class="lessonInfo">
        <h2>General Lesson Information</h2>
        <form id="lessonInfo" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <label class="boldLabel">Type of Lesson: </label>
            <input type="radio" id="lessonTypeSki" name="lessonType" value="ski" <?php if(isset($_SESSION['lessonType'])) { if($_SESSION['lessonType'] == 'ski') { echo 'checked';}} ?>>
            <label for="ski">Ski </label>
            <input type="radio" id="lessonTypeSB" name="lessonType" value="SB" <?php lessonTypeChecked('SB'); ?>>
            <label for="SB">Snowboard </label>
            <br/><br/>
            <label class="boldLabel">Date of Lesson: </label>
            <input type="date" name="dateOfLesson" id="dateOfLesson" min=<?php echo $minDate;?> value=<?php getDateOfLesson(); ?>>
            <br/><br/>
            <label class="boldLabel">Time of Lesson: </label>
            <input type="time" name="timeOfLesson" id="timeOfLesson" min="07:00" max="21:00" value=<?php getTimeOfLesson(); ?>>
            <br/><br/>
            <label class="boldLabel">Length of Lesson: </label>
            <input type="number" name="lenOfLesson" id="lenOfLesson" step="0.5" value=<?php getLenOfLesson(); ?>>
            <label> hour(s)</label>
            <br/><br/>
            <label class="boldLabel">Lesson Level: </label>
            <input type="text" name="lessonLvl" id="lessonLvl" size="3" maxlength="3" value=<?php getLessonLvl(); ?>>
            <br/><br/>
            <label class="boldLabel">Instructor: </label>
            <input type="text" name="instructor" id="instructor" value=<?php getInstructor(); ?>>
            <label class="boldLabel">&nbsp;Requested? </label>
            <input type="checkbox" name="requested" id="requested" value="requested" <?php getRequested(); ?>>
            <br/><br/>
            <label class="boldLabel">Notes: </label>
            <input type="text" name="lessonNotes" id="lessonNotes" width="50" value=<?php getLessonNotes(); ?>>
            <br/><br>
            <label class="boldLabel">Clerk: </label>
            <input type="text" name="clerkName" id="clerkName" maxlength="3" value=<?php getClerkName(); ?>>
            <br /><br />
            <input type="hidden" id="client1Hid" name="hidClient1" value="<?php getClientIDInput('1');?>">
            <input type="hidden" id="client2Hid" name="hidClient2" value="<?php getClientIDInput('2');?>">
            <input type="hidden" id="client3Hid" name="hidClient3" value="<?php getClientIDInput('3'); ?>">
            <input type="hidden" id="totalNumOfClientsInThisLesson" name="totalNumOfClientsInThisLesson" value="<?php getTotNumInLesson(); ?>" >
            <!-- lesson buttons -->
            <input type="submit" value="Add Lesson" name="addLessonBtn" id="addLessonBtn" onclick="<?php addLessonToDB(); ?>">
            <button id="cancelAddingLesson" onclick="clearAllClientIDs();">Cancel</button>
        </form>
        </div>

<!-- add and delete students from lesson buttons and label -->
        <h2>Student(s)</h2>
        <label id="client1Lbl" class="clientLabel"><?php if (isset($_SESSION['hidClient1'])) { getClientInfo($_SESSION['hidClient1']);} ?></label>
        <button id="client1Dlt" class="delBtn" onclick="delClientFromLesson(1);">Delete</button>
        <br/>
        <label id="client2Lbl" class="clientLabel"><?php if (isset($_SESSION['hidClient2'])) { getClientInfo($_SESSION['hidClient2']);} ?></label>
        <button id="client2Dlt" class="delBtn" onclick="delClientFromLesson(2);">Delete</button>
        <br />
        <label id="client3Lbl" class="clientLabel"><?php if (isset($_SESSION['hidClient3'])) { getClientInfo($_SESSION['hidClient3']);} ?></label>
        <button id="client3Dlt" class="delBtn" onclick="delClientFromLesson(3);">Delete</button>
        <br />

<!-- add client button -->
        <label class="boldLabel" id="addPersonLabel">Add Client</label>
        <button id="addClientBtn" onclick="openForm();">+</button>

<!-- add new client info -->
        <div class="form-popup" id="clientInfo">
          <!-- database integration -->
          <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" class="form-container" method="POST" id="clientForm">
            <h3>Add New Client</h3>
            <label for="fullName" id="fullNameLbl"><b>*Name:</b></label>
            <select name="fullName" id="fullNamedd" onchange="exists();">
                <option value="-1"> </option>
                <?php getClientNames(); ?>
                <option value="0">&lt;Add New Client&gt;</option>
            </select>

            <label for="fname" id="firstNameLbl"><b>*First Name:</b></label>
            <input type="text" name="fname" id="fname">

            <label for="lname" id="lastNameLbl"><b>*Last Name:</b></label>
            <input type="text" name="lname" id="lname">

            <label for="age"><b>*Age:</b></label>
            <input type="text" name="age" required>

            <label for="parent"><b>Parent:</b></label>
            <input type="text" name="parent">

            <label for="phone"><b>*Phone:</b></label>
            <input type="text" name="phone" required>

            <label for="notes"><b>Notes:</b></label>
            <input type="text" name="notes">

<!-- BUTTON THAT NEEDS FIXING -->
<!-- hidden client info -->
            <input type="submit" id="addPersonBtn" name="addPersonBtn" class="btn" value="Add Client" onclick="<?php addClientToDB(); ?>">
            <input type="button" id="cancelBtn" name="cancelBtn" class="btnCancel" onclick="closeForm();" value="Close">
            <input type="hidden" id="hidClient1" name="hidClient1AddClientForm" value="<?php getClientIDInput('1'); ?>">
            <input type="hidden" id="hidClient2" name="hidClient2AddClientForm" value="<?php getClientIDInput('2'); ?>">
            <input type="hidden" id="hidClient3" name="hidClient3AddClientForm" value="<?php getClientIDInput('3'); ?>">
            <input type="hidden" id="totalNumOfClientsInThisLesson2" name="totalNumOfClientsInThisLesson" value="<?php getTotNumInLesson(); ?>" >
          </form>
        </div>

        <script>
            var fullNameLbl = document.getElementById("fullNameLbl");
            var fullNameDd = document.getElementById("fullNamedd");
            var firstNameLbl = document.getElementById("firstNameLbl");
            var firstNameBox = document.getElementById("fname");
            var lastNameLbl = document.getElementById("lastNameLbl");
            var lastNameBox = document.getElementById("lname");
            var client1Lbl = document.getElementById("client1Lbl");
            var client1HidGenLess = document.getElementById("client1Hid");
            var client1DelBtn = document.getElementById('client1Dlt');
            client1DelBtn.style.display = "none";
            var client1HidClientForm = document.getElementById("hidClient1");
            var client2Lbl = document.getElementById("client2Lbl");
            var client2HidGenLess = document.getElementById("client2Hid");
            var client2DelBtn = document.getElementById('client2Dlt');
            client2DelBtn.style.display = "none";
            var client2HidClientForm = document.getElementById("hidClient2");
            var client2Lbl = document.getElementById("client2Lbl");
            var client3HidGenLess = document.getElementById("client3Hid");
            var client3DelBtn = document.getElementById('client3Dlt');
            client3DelBtn.style.display = "none";
            var client3HidClientForm = document.getElementById("hidClient3");
            var addLessonBtn = document.getElementById('addLessonBtn');
            var totNumOfClients = document.getElementById('totalNumOfClientsInThisLesson');
            var totNumOfClients2 = document.getElementById('totalNumOfClientsInThisLesson2');

//open and close form
            function openForm() {
                document.getElementById("clientInfo").style.display = "block";
            }

            function closeForm() {
                document.getElementById("clientInfo").style.display = "none";
                fullNameDd.value = -1;
                exists();
            }

//add client to student view
            window.onload = function addToStudentView() {
                closeForm();
                var id = "<?php if(isset($addedClientID)) {echo $addedClientID;}?>";
                totNumOfClients.value = parseInt(<?php getTotNumInLesson(); ?>);
                if (totNumOfClients.value > 0) {
                    switch(totNumOfClients.value) {
                        case '1':
                            var id1 = "<?php if(isset($_SESSION['hidClient1'])) {echo $_SESSION['hidClient1'];} else { echo -1;} ?>";
                            var str1 = "<?php if (isset($_SESSION['hidClient1'])) { getClientInfo($_SESSION['hidClient1']); } ?>";
                            addClientToStuView(id1, str1, 1);
                            break;
                        case '2':
                            var id1 = "<?php if(isset($_SESSION['hidClient1'])) {echo $_SESSION['hidClient1'];} else { echo -1;} ?>";
                            var str1 = "<?php if (isset($_SESSION['hidClient1'])) { getClientInfo($_SESSION['hidClient1']); } ?>";
                            addClientToStuView(id1, str1, 1);
                            var id2 = "<?php if(isset($_SESSION['hidClient2'])) {echo $_SESSION['hidClient2'];} else { echo -1;} ?>";
                            var str2 = "<?php if (isset($_SESSION['hidClient2'])) { getClientInfo($_SESSION['hidClient2']);  }?>";
                            addClientToStuView(id2, str2, 2);
                            break;
                        case '3':
                            var id1 = "<?php if(isset($_SESSION['hidClient1'])) {echo $_SESSION['hidClient1'];} else { echo -1;} ?>";
                            var str1 = "<?php if (isset($_SESSION['hidClient1'])) { getClientInfo($_SESSION['hidClient1']); } ?>";
                            addClientToStuView(id1, str1, 1);
                            var id2 = "<?php if(isset($_SESSION['hidClient2'])) {echo $_SESSION['hidClient2'];} else { echo -1;} ?>";
                            var str2 = "<?php if (isset($_SESSION['hidClient2'])) { getClientInfo($_SESSION['hidClient2']);  }?>";
                            addClientToStuView(id2, str2, 2);
                            var id3 = "<?php if(isset($_SESSION['hidClient3'])) {echo $_SESSION['hidClient3'];} else { echo -1;} ?>";
                            var str3 = "<?php if (isset($_SESSION['hidClient3'])) { getClientInfo($_SESSION['hidClient3']);  }?>";
                            addClientToStuView(id3, str3, 3);
                            break;
                        default:
                            //shouldn't go in here
                    }
                }
                if (id != "" && totNumOfClients.value < 3) {
                    totNumOfClients.value = parseInt(totNumOfClients.value) + 1;
                    totNumOfClients2.value = totNumOfClients.value;
                    str = "<?php getClientInfo($addedClientID); ?>";
                    addClientToStuView(id, str, totNumOfClients.value);
                    if (totNumOfClients.value == 2) {
                        var id1 = "<?php if(isset($_SESSION['hidClient1'])) {echo $_SESSION['hidClient1'];} else { echo -1;} ?>";
                        var str1 = "<?php if (isset($_SESSION['hidClient1'])) { getClientInfo($_SESSION['hidClient1']); } ?>";
                        addClientToStuView(id1, str1, 1);
                    }
                    if (totNumOfClients.value == 3) {
                        var id1 = "<?php if(isset($_SESSION['hidClient1'])) {echo $_SESSION['hidClient1'];} else { echo -1;} ?>";
                        var str1 = "<?php if (isset($_SESSION['hidClient1'])) { getClientInfo($_SESSION['hidClient1']); } ?>";
                        addClientToStuView(id1, str1, 1);
                        var id2 = "<?php if(isset($_SESSION['hidClient2'])) {echo $_SESSION['hidClient2'];} else { echo -1;} ?>";
                        var str2 = "<?php if (isset($_SESSION['hidClient2'])) { getClientInfo($_SESSION['hidClient2']);  }?>";
                        addClientToStuView(id2, str2, 2);
                    }
                    <?php if (isset($_POST['addLessonBtn'])) { resetClientID();} ?>
                }
                (parseInt(totNumOfClients.value) == 0) ? addLessonBtn.style.display = "none": addLessonBtn.style.display = "";
            }

            function movStudentView(id, str, num) {
                addClientToStuView(id, str, num);
                clearClient(totNumOfClients.value);
            }

            function exists() {
                if (fullNameDd.value == -1) {
                    fullNameDd.style.display = "block";
                    fullNameLbl.style.display = "block";
                    firstNameLbl.style.display = "none";
                    firstNameBox.style.display = "none";
                    focus(firstNameBox);
                    lastNameLbl.style.display = "none";
                    lastNameBox.style.display = "none";
                }
                else {
                    fullNameDd.style.display = "none";
                    fullNameLbl.style.display = "none";
                    firstNameLbl.style.display = "block";
                    firstNameBox.style.display = "block";
                    lastNameLbl.style.display = "block";
                    lastNameBox.style.display = "block";
                    if (fullNameDd.value > 0) {
                        var selVal = fullNameDd.value;
                        closeForm();
                        for (i = 0; i < fullNameDd.length; i++) {
                            var currOpt = fullNameDd.options[i].value;
                            if (selVal == currOpt) {
                                if (totNumOfClients.value < 3) {
                                    totNumOfClients.value = parseInt(totNumOfClients.value) + 1;
                                    totNumOfClients2.value = totNumOfClients.value;
                                    addLessonBtn.style.display = "";
                                    addClientToStuView(selVal, fullNameDd.options[i].text, totNumOfClients.value);
                                }
                            }
                        }
                    }
                }
            }

//add client to lesson list
            function addClientToStuView(id, str, num) {
                if (parseInt(num) == 1) {
                    client1Lbl.innerHTML = str;
                    client1DelBtn.style.display = "";
                    client1HidGenLess.value = id;
                    client1HidClientForm.value = id;
                }
                if (parseInt(num) == 2) {
                    client2Lbl.innerHTML = str;
                    client2DelBtn.style.display = "";
                    client2HidGenLess.value = id;
                    client2HidClientForm.value = id;
                }
                if (parseInt(num) == 3) {
                    client3Lbl.innerHTML = str;
                    client3DelBtn.style.display = "";
                    client3HidGenLess.value = id;
                    client3HidClientForm.value = id;
                }
            }

//clear client
            function clearClient(num) {
                if (parseInt(num) == 1) {
                    client1Lbl.innerHTML = '';
                    client1HidGenLess.value = '';
                    client1HidClientForm.value = ""
                    client1DelBtn.style.display = "none";
                }
                if (parseInt(num) == 2) {
                    client2Lbl.innerHTML = '';
                    client2HidGenLess.value = '';
                    client2HidClientForm.value = '';
                    client2DelBtn.style.display = "none";
                }
                if (parseInt(num) == 3) {
                    client3Lbl.innerHTML = '';
                    client3HidGenLess.value = '';
                    client3HidClientForm.value = '';
                    client3DelBtn.style.display = "none";
                }
            }

//clear all clients
            function clearAllClientIDs() {
                <?php session_unset(); ?>
            }

// delete single client from lesson
            function delClientFromLesson(num) {
                if (parseInt(num) == 1) {
                    var numPeople = totNumOfClients.value;
                    clearClient(1);
                    if (parseInt(numPeople) == 2) {
                        movStudentView(client2HidGenLess.value, client2Lbl.innerHTML, 1);
                    }
                    if (parseInt(numPeople) == 3) {
                        movStudentView(client2HidGenLess.value, client2Lbl.innerHTML, 1);
                        movStudentView(client3HidGenLess.value, client3Lbl.innerHTML, 2);
                    }
                }
                if (parseInt(num) == 2) {
                    var numPeople = totNumOfClients.value;
                    clearClient(2);
                    if (parseInt(numPeople) == 3) {
                        movStudentView(client3HidGenLess.value, client3Lbl.innerHTML, 2);
                    }
                }
                if (parseInt(num) == 3) {
                    clearClient(3);
                }
                totNumOfClients.value = parseInt(totNumOfClients.value) - 1;
                totNumOfClients2.value = totNumOfClients.value;
                if (totNumOfClients.value == 0) {
                    addLessonBtn.style.display = "none";
                }
            }
        </script>
    </body>
</html>
