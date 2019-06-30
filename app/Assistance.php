<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

//helper

class Assistance
{
    public static function coursesReserved($date, $begin, $end, $id)
    {
        //in app/user.php has same function,too
        $reserves = Reserve::whereHas('schedule', function ($q) use ($date, $begin, $end) {
            $q->where('date', $date)->where('begintime', $begin)->where('endtime', $end);
        })->where('user_id', $id)->get();


        if (count($reserves) <= 0) {
            return;
        }
        $result = "";
        $step = 1;
        foreach ($reserves as $reserve) {
            $course = Course::find($reserve->course_id);
            if (empty($course)) {
                return;
            }

            $result =  $result. '  <br> ' .
                $step .
                '-' .
                ' ' . $course->lessonMajor->lesson->name . ' - ' . $course->lessonMajor->major->code . ' - (' . $course->term->season . '-' . $course->term->year . ' )'
               ;
            $step++;

        }
        return $result;
    }

    public static function haveVCSchedule($startDate, $endDate=null)
    {
        $endDate=date("Y-m-d", strtotime("$startDate +7 day"));
        $schedules = Schedule::whereBetween('date', array($startDate, $endDate))
            ->whereType('مجازی')->first();

        if ($schedules == null)
            return false;
        else
            return true;
    }


    public static function haveIIT($date, $begin, $end, $id)
    {
        //in app/user.php has same function,too
        $res = User::whereHas('reserves', function ($q) use ($date, $begin, $end) {
            $q->whereHas('schedule', function ($q1) use ($date, $begin, $end) {
                $q1->where('date', $date)->where('begintime', $begin)->where('endtime', $end);
            });
        })->where('id', $id)->first();

        if ($res == null)
            return false;
        else
            return true;
    }


    public static function getExcelStep($int)
    {
        $array = ['0' => 'A', '1' => 'B', '2' => 'C', '3' => 'D', '4' => 'E', '5' => 'F', '6' => 'G', '7' => 'H', '8' => 'I', '9' => 'J'
            , '10' => 'K', '11' => 'L', '12' => 'M', '13' => 'N', '14' => 'O', '15' => 'P', '16' => 'Q', '17' => 'R', '18' => 'S', '19' => 'T'
            , '20' => 'U', '21' => 'V', '22' => 'X', '23' => 'Y', '24' => 'Z'];
        return $array[$int];

    }

    public static function amIHere($routeName, $key)
    {
        $attendance = ['myCurrentPlan' => 'رزروهای من', 'allPlan' => 'کلیه رزروها', 'attendances.update' => 'ثبت حضور و غیاب', 'attendances.index' => 'لیست دانشجویان',
            'attendance.courses' => 'لیست دروس', 'attendance.students' => 'سوابق حضور دانشجو'
            ,'dayReport'=>'گزارش حضور و غیاب انجام شده' ,'attendance.done'=>'حضور و غیاب های انجام شده'
        ];

        $user = ['experts' => 'کارشناسان', 'addExpert' => 'افزودن کارشناس', 'addExpertPost' => '', 'managers' => 'مدیران آموزش'
            , 'addManager' => 'افزودن مدیر آموزش', 'updateManager' => 'ویرایش مدیر آموزش', 'updateExpertPost' => ''
            , 'teachers' => 'اساتید', 'addTeacher' => 'افزودن استاد', 'addTeacherPost' => '', 'updateTeacher' => 'ویرایش استاد', 'updateTeacherPost' => ''
            , 'assists' => 'دستیاران', 'addAssist' => 'افزودن دستیار', 'addAssistPost' => '', 'updateAssist' => 'ویرایش دستیار', 'updateAssistPost' => ''
            , 'users' => 'کاربران', 'addUser' => 'افزودن کاربر', 'addUserPost' => '', 'updateUser' => 'ویرایش کاربر', 'updateUserPost' => '', 'profile' => 'ویرایش پروفایل'
            , 'forget' => 'بازیابی رمز عبور'];

        $major = ['majors' => 'رشته ها', 'addMajor' => 'افزودن رشته', 'addMajorPost' => '', 'updateMajor' => 'ویرایش رشته', 'updateMajorPost' => ''];
        $setting = ['setting' => 'تنظیمات' ,'activities.index'=>'لاگ'];

        $lesson = ['addLesson' => 'افزودن درس', 'addLessonPost' => '', 'updateLesson' => 'ویرایش درس', 'updateLessonPost' => '', 'lessons' => 'دروس'];

        $auth = ['addRole' => 'افزودن نقش', 'addRolePost' => '', 'addPermission' => 'افزودن عمل', 'addPermissionPost' => '', 'updateRole' => 'ویرایش نقش'
            , 'updateRolePost' => '', 'updatePermission' => 'ویرایش عمل', 'updatePermissionPost' => '', 'roles' => 'نقش ها', 'permissions' => 'عمل ها'];

        $department = ['departments' => ' موسسه ها', 'addDepartment' => 'افزودن موسسه', 'addDepartmentPost' => '', 'updateDepartment' => 'ویرایش موسسه', 'updateDepartmentPost' => ''];
        $classrooms = ['classrooms.index' => ' کلاس ها', 'classrooms.create' => 'افزودن کلاس', 'classrooms.store' => '', 'classrooms.edit' => 'ویرایش کلاس', 'classrooms.update' => '', 'classrooms.reserves' => 'انتصاب کلاس'];
        $students = ['students.index' => ' دانشجویان', 'students.create' => 'افزودن دانشجو', 'students.store' => '', 'students.edit' => 'ویرایش دانشجو', 'students.update' => '', 'students.assign' => 'انتصاب دانشجو','students.course'=>'انتصاب دانشجو'];
        $schedules = ['schedules.index' => ' زمانبندی', 'schedules.create' => 'افزودن زمانبندی', 'schedules.store' => '', 'schedules.edit' => 'ویرایش زمانبندی', 'schedules.update' => '', 'schedules.show' => 'زمانبندی پر شده '];
        $vschedules = ['vschedules.index' => ' زمانبندی کلاس مجازی', 'vschedules.create' => 'افزودن زمانبندی کلاس مجازی', 'vschedules.store' => '', 'vschedules.edit' => 'ویرایش زمانبندی  کلاس مجازی', 'vschedules.update' => '', 'vschedules.show' => 'زمانبندی  '];

        $term = ['terms' => 'ترم ها', 'addTerm' => 'افزودن ترم', 'addTermPost' => '', 'updateTerm' => 'ویرایش ترم', 'updateTermPost' => ''];

        $course = ['courses' => 'گروه های درسی', 'addCourse' => 'افزودن گروه درسی', 'addCoursePost' => '', 'updateCourse' => 'ویرایش گروه درسی', 'updateCoursePost' => ''];
        $report = ['reportTeachers' => 'گزارش استاد', 'reportMajors' => 'گزارش رشته', 'reportByTeacher' => 'گزارش استاد', 'reportByMajor' => 'گزارش رشته'
            , 'neverReserved' => 'گزارش استاد بدون رزور', 'neverReservedResult' => 'گزارش استاد بدون رزرو', 'notReserved' => 'گزارش استاد کم کار', 'notReservedResult' => 'گزارش استاد کم کار',
            'dayClass' => 'برنامه کلاسی', 'dayClassResult' => 'برنامه کلاسی', 'weekClass' => 'برنامه کلاس مجازی', 'weekClassResult' => 'برنامه کلاس مجازی'];

        $room = ['rooms' => 'کلاس ها', 'addRoom' => 'افزودن کلاس', 'addRoomPost' => '', 'updateRoom' => 'کلاس ها', 'updateRoomPost' => ''];

        $reserve = ['reserves' => 'رزرو کردن','reserves_for_teacher' => ' رزرو برای استاد','merge' => 'ادغام کردن ', 'myReserves' => 'رزرو های من', 'pendingReserves' => '', 'myPlan' => 'برنامه من', 'myPlanHourly' => 'برنامه ساعتی من'
            , 'rejectReserve' => '', 'acceptReserve' => '', 'reserve' => 'رزرو', 'reserved' => 'رزرو شده ها', 'rooms' => 'برنامه ریزی ها'
            , 'addRoom' => 'افزودن کلاس', 'addRoomPost' => '', 'updateRoom' => 'کلاس ها', 'updateRoomPost' => ''
        ,'VCReserves.create'=>'ثبت رزرو کلاس مجازی','VCReserves.store'=>'ثبت رزرو کلاس مجازی'

        ];

        $subject = ['subjects' => 'موضوعات', 'addSubject' => 'افزودن موضوع', 'addSubjectPost' => '', 'updateSubject' => 'ویرایش موضوع', 'updateSubjectPost' => ''];

        $ticket = ['tickets' => 'پیام ها', 'myTickets' => 'پیام های من', 'openTickets' => 'پیام های باز', 'newTicket' => 'ایجاد پیام جدید', 'newTicketPost' => ''
            , 'showTicket' => 'نمایش پیام', 'replyTicket' => 'پاسخ به پیام', 'replyTicketPost' => '', 'adminReplyTicket' => 'پاسخ به پیام', 'adminReplyTicketPost' => ''
            , 'closeTicket' => 'بستن پیام', 'adminCloseTicket' => 'بستن پیام'];


        if ($key == 'user') {
            return array_key_exists($routeName, $user);
        }

        if ($key == 'major') {
            return array_key_exists($routeName, $major);
        }
        if ($key == 'report') {
            return array_key_exists($routeName, $report);
        }

        if ($key == 'lesson') {
            return array_key_exists($routeName, $lesson);
        }

        if ($key == 'auth') {
            return array_key_exists($routeName, $auth);
        }
        if ($key == 'setting') {
            return array_key_exists($routeName, $setting);
        }

        if ($key == 'department') {
            return array_key_exists($routeName, $department);

        }
        if ($key == 'classrooms') {
            return array_key_exists($routeName, $classrooms);

        }
        if ($key == 'students') {
            return array_key_exists($routeName, $students);

        }
        if ($key == 'schedules') {
            return array_key_exists($routeName, $schedules);

        }
        if ($key == 'vschedules') {
            return array_key_exists($routeName, $vschedules);

        }

        if ($key == 'term') {
            return array_key_exists($routeName, $term);
        }

        if ($key == 'course') {
            return array_key_exists($routeName, $course);
        }

        if ($key == 'room') {
            return array_key_exists($routeName, $room);
        }

        if ($key == 'reserve') {
            return array_key_exists($routeName, $reserve);

        }

        if ($key == 'subject') {
            return array_key_exists($routeName, $subject);

        }
        if ($key == 'ticket') {
            return array_key_exists($routeName, $ticket);
        }
        if ($key == 'attendance') {
            return array_key_exists($routeName, $attendance);
        }

    }

    public static function getTitle($routeName)
    {
        $attendance = ['myCurrentPlan' => 'رزروهای من', 'allPlan' => 'کلیه رزروها', 'attendances.update' => 'ثبت حضور و غیاب', 'attendances.index' => 'لیست دانشجویان',
            'attendance.courses' => 'لیست دروس',
            'attendanceDay' => 'کلیه رزروها برای روز خاصی'
            , 'attendance.students' => 'سوابق حضور دانشجو'
            ,'dayReport'=>'گزارش حضور و غیاب انجام شده' ,'attendance.done'=>'حضور و غیاب های انجام شده'
        ];

        $user = ['experts' => 'کارشناسان', 'addExpert' => 'افزودن کارشناس', 'addExpertPost' => '', 'managers' => 'مدیران آموزش', 'addManager' => 'افزودن مدیر آموزش', 'updateManager' => 'ویرایش مدیر آموزش', 'updateExpertPost' => ''
            , 'teachers' => 'اساتید', 'addTeacher' => 'افزودن استاد', 'addTeacherPost' => '', 'updateTeacher' => 'ویرایش استاد', 'updateTeacherPost' => ''
            , 'assists' => 'دستیاران', 'addAssist' => 'افزودن دستیار', 'addAssistPost' => '', 'updateAssist' => 'ویرایش دستیار', 'updateAssistPost' => ''
            , 'users' => 'کاربران', 'addUser' => 'افزودن کاربر', 'addUserPost' => '', 'updateUser' => 'ویرایش کاربر', 'updateUserPost' => '', 'profile' => 'ویرایش پروفایل'
            , 'forget' => 'بازیابی رمز عبور'];

        $setting = ['setting' => 'تنظیمات' ,'activities.index'=>'لاگ'];

        $major = ['majors' => 'رشته ها', 'addMajor' => 'افزودن رشته', 'addMajorPost' => '', 'updateMajor' => 'ویرایش رشته', 'updateMajorPost' => ''];
        $report = ['reportTeachers' => 'گزارش استاد', 'reportMajors' => 'گزارش رشته', 'reportByTeacher' => 'گزارش استاد', 'reportByMajor' => 'گزارش رشته'
            , 'neverReserved' => 'گزارش استاد بدون رزور', 'neverReservedResult' => 'گزارش استاد بدون رزرو', 'notReserved' => 'گزارش درس بدون رزور', 'notReservedResult' => 'گزارش درس بدون رزرو',
            'dayClass' => 'برنامه کلاسی', 'dayClassResult' => 'برنامه کلاسی', 'weekClass' => 'برنامه کلاس مجازی', 'weekClassResult' => 'برنامه کلاس مجازی'];

        $lesson = ['addLesson' => 'افزودن درس', 'addLessonPost' => '', 'updateLesson' => 'ویرایش درس', 'updateLessonPost' => '', 'lessons' => 'دروس'];

        $auth = ['addRole' => 'افزودن نقش', 'addRolePost' => '', 'addPermission' => 'افزودن عمل', 'addPermissionPost' => '', 'updateRole' => 'ویرایش نقش'
            , 'updateRolePost' => '', 'updatePermission' => 'ویرایش عمل', 'updatePermissionPost' => '', 'roles' => 'نقش ها', 'permissions' => 'عمل ها', 'setting' => 'تنظیمات'];

        $department = ['departments' => ' موسسه ها', 'addDepartment' => 'افزودن موسسه', 'addDepartmentPost' => '', 'updateDepartment' => 'ویرایش موسسه', 'updateDepartmentPost' => ''];
        $classrooms = ['classrooms.index' => ' کلاس ها', 'classrooms.create' => 'افزودن کلاس', 'classrooms.store' => '', 'classrooms.edit' => 'ویرایش کلاس', 'classrooms.update' => '', 'classrooms.reserves' => 'انتصاب کلاس'];
        $students = ['students.index' => ' دانشجویان', 'students.create' => 'افزودن دانشجو', 'students.store' => '', 'students.edit' => 'ویرایش دانشجو', 'students.update' => '', 'students.assign' => 'انتصاب دانشجو','students.course'=>'انتصاب دانشجو'];
        $schedules = ['schedules.index' => ' زمانبندی', 'schedules.create' => 'افزودن زمانبندی', 'schedules.store' => '', 'schedules.edit' => 'ویرایش زمانبندی', 'schedules.update' => '', 'schedules.show' => 'زمانبندی پر شده '];
        $vschedules = ['vschedules.index' => ' زمانبندی کلاس مجازی', 'vschedules.create' => 'افزودن زمانبندی کلاس مجازی', 'vschedules.store' => '', 'vschedules.edit' => 'ویرایش زمانبندی  کلاس مجازی', 'vschedules.update' => '', 'vschedules.show' => 'زمانبندی  '];
        $term = ['terms' => 'ترم ها', 'addTerm' => 'افزودن ترم', 'addTermPost' => '', 'updateTerm' => 'ویرایش ترم', 'updateTermPost' => ''];

        $course = ['courses' => 'گروه های درسی', 'addCourse' => 'افزودن گروه درسی', 'addCoursePost' => '', 'updateCourse' => 'ویرایش گروه درسی', 'updateCoursePost' => ''];


        $room = ['reserved' => 'کلاس های رزرو شده', 'rooms' => 'کلاس ها', 'addRoom' => 'افزودن کلاس', 'addRoomPost' => '', 'updateRoom' => 'کلاس ها', 'updateRoomPost' => ''];

        $reserve = ['reserves' => 'رزرو کردن','reserves_for_teacher' => ' رزرو برای استاد','merge' => 'ادغام کردن ', 'myReserves' => 'رزرو های من', 'pendingReserves' => '', 'myPlan' => 'برنامه من', 'myPlanHourly' => 'برنامه ساعتی من'
            , 'rejectReserve' => '', 'acceptReserve' => '', 'reserve' => 'رزرو', 'reserved' => 'رزرو شده ها', 'rooms' => 'برنامه ریزی ها'
            , 'addRoom' => 'افزودن کلاس', 'addRoomPost' => '', 'updateRoom' => 'کلاس ها', 'updateRoomPost' => ''
            ,'VCReserves.create'=>'ثبت رزرو کلاس مجازی','VCReserves.store'=>'ثبت رزرو کلاس مجازی'
        ];


        $subject = ['subjects' => 'موضوعات', 'addSubject' => 'افزودن موضوع', 'addSubjectPost' => '', 'updateSubject' => 'ویرایش موضوع', 'updateSubjectPost' => ''];

        $ticket = ['tickets' => 'پیام ها', 'myTickets' => 'پیام های من', 'openTickets' => 'پیام های باز', 'newTicket' => 'ایجاد پیام جدید', 'newTicketPost' => ''
            , 'showTicket' => 'نمایش پیام', 'replyTicket' => 'پاسخ به پیام', 'replyTicketPost' => '', 'adminReplyTicket' => 'پاسخ به پیام', 'adminReplyTicketPost' => ''
            , 'closeTicket' => 'بستن پیام', 'adminCloseTicket' => 'بستن پیام'];
        $help = ['help.teacher' => 'راهنما'];

        if (array_key_exists($routeName, $attendance)) {
            return $attendance[$routeName];
        }

        if (array_key_exists($routeName, $user)) {
            return $user[$routeName];
        }

        if (array_key_exists($routeName, $major)) {
            return $major[$routeName];
        }

        if (array_key_exists($routeName, $lesson)) {
            return $lesson[$routeName];
        }
        if (array_key_exists($routeName, $setting)) {
            return $setting[$routeName];
        }

        if (array_key_exists($routeName, $auth)) {
            return $auth[$routeName];
        }
        if (array_key_exists($routeName, $report)) {
            return $report[$routeName];
        }

        if (array_key_exists($routeName, $department)) {
            return $department[$routeName];
        }

        if (array_key_exists($routeName, $classrooms)) {
            return $classrooms[$routeName];
        }
        if (array_key_exists($routeName, $students)) {
            return $students[$routeName];
        }

        if (array_key_exists($routeName, $schedules)) {
            return $schedules[$routeName];
        }
        if (array_key_exists($routeName, $vschedules)) {
            return $vschedules[$routeName];
        }

        if (array_key_exists($routeName, $term)) {
            return $term[$routeName];
        }

        if (array_key_exists($routeName, $course)) {
            return $course[$routeName];
        }

        if (array_key_exists($routeName, $room)) {
            return $room[$routeName];
        }

        if (array_key_exists($routeName, $reserve)) {
            return $reserve[$routeName];
        }

        if (array_key_exists($routeName, $subject)) {
            return $subject[$routeName];
        }

        if (array_key_exists($routeName, $ticket)) {
            return $ticket[$routeName];
        }
        if (array_key_exists($routeName, $help)) {
            return $help[$routeName];
        }

    }

    public static function imagePath()
    {
        return 'upload/images/';
    }

    public static function getMinute($time)
    {
        $time = explode(',', $time);
        $start = explode(':', $time[0])[0] * 60 + explode(':', $time[0])[1];
        $end = explode(':', $time[1])[0] * 60 + explode(':', $time[1])[1];
        return ['start' => $start, 'end' => $end];
    }

    public static function getSingleMinute($time)
    {
        $min = explode(':', $time)[0] * 60 + explode(':', $time)[1];
        return $min;
    }

    public static function getHour($time)
    {
        $hours = intval($time / 60);
        $minutes = $time - ($hours * 60);
        if ($minutes == 59) {
            $minutes = 0;
            $hours++;
        }
        if (strlen($hours) < 2)
            $hours = '0' . $hours;
        if (strlen($minutes) < 2)
            $minutes = '0' . $minutes;
        return $hours . ':' . $minutes;
    }


    public static function convertDateToJalaliToShow($date)
    {
        $date = str_replace('/', '-', $date);
        $date = explode('-', $date);
        $date = DateToJalali::gregorian_to_jalali((int)$date[0], (int)$date[1], (int)$date[2]);
        return $date['year'] . '/' . $date['month'] . '/' . $date['day'];
    }

    public static function getDayName($date)
    {
        $time = Carbon::parse($date);
        return self::daysString($time->format('l'));
    }

    public static function daysString($day)
    {
        $search = array("Saturday", "Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday");
        $replace = array("شنبه", "یک شنبه", "دو شنبه", "سه شنبه", "چهار شنبه", "پنج شنبه", "جمعه");
        return $result = str_replace($search, $replace, $day);

    }
    public static function monthString($date)
    {
        $date = str_replace('/', '-', $date);
        $date = explode('-', $date);
        $date = DateToJalali::gregorian_to_jalali((int)$date[0], (int)$date[1], (int)$date[2]);
        $arr=array(
            1=>"فروردین",
            2=>"اردیبهشت",
            3=>"خرداد",
            4=>"تیر",
            5=>"مرداد",
            6=>"شهریور",
            7=>"مهر",
            8=>"آبان",
            9=>"آذر",
            10=>"دی",
            11=>"بهمن",
            12=>"اسفند"
        );

        return  $arr[$date['month']] . 'ماه';

    }

    public static function convertCarbonDateToJalaliToShow($date)
    {
        $time = Carbon::parse($date);
        $date = [];
        $date['year'] = $time->year;
        $date['month'] = $time->month;
        $date['day'] = $time->day;
        $date['hour'] = $time->hour;
        $date['minute'] = $time->minute;
        $date['second'] = $time->second;
        $newDate = DateToJalali::gregorian_to_jalali($date['year'], $date['month'], $date['day']);
        return $date['hour'] . ":" . $date['minute'] . ":" . $date['second'] . ' - ' . $newDate['year'] . '/' . $newDate['month'] . '/' . $newDate['day'];
    }
    public static function getSemesterWeek(): array
    {
        $thisYear = Carbon::today()->format('Y');
        $primaryDate = $thisYear . '-09-7';
//        if(Carbon::today()->format('m')<6) {
//            $primaryDate = $thisYear -1 . '-09-7';
//        }
        $date = array(
            'mehr' => array(),
            'bahman' => array(),
        );


        for ($i = 1; $i <= 18; $i++) {
            if (Assistance::haveVCSchedule($primaryDate)) {
                array_push($date['mehr'], $primaryDate);
            }
            $primaryDate = date("Y-m-d", strtotime("$primaryDate +7 day"));
        }

        for ($i = 1; $i <= 20; $i++) {
            if(Assistance::haveVCSchedule($primaryDate)){
                array_push($date['bahman'], $primaryDate);
            }
            $primaryDate = date("Y-m-d", strtotime("$primaryDate +7 day"));
        }
        return $date;
    }

}
