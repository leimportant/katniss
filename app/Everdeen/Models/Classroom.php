<?php

namespace Katniss\Everdeen\Models;

use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
    const STATUS_OPENING = 1;
    const STATUS_CLOSED = 0;

    protected $table = 'classrooms';

    protected $fillable = [
        'student_id', 'teacher_id', 'supporter_id', 'status', 'hours', 'name'
    ];

    public function getIsOpeningAttribute()
    {
        return $this->attributes['status'] == self::STATUS_OPENING;
    }

    public function getDurationAttribute()
    {
        return toFormattedNumber($this->attributes['hours']);
    }

    public function getSpentTimeAttribute()
    {
        return $this->classTimes()->sum('hours');
    }

    public function getSpentTimeDurationAttribute()
    {
        return toFormattedNumber($this->spentTime);
    }

    public function teacherProfile()
    {
        return $this->belongsTo(Teacher::class, 'teacher_id', 'user_id');
    }

    public function teacherUserProfile()
    {
        return $this->belongsTo(User::class, 'teacher_id', 'id');
    }

    public function studentProfile()
    {
        return $this->belongsTo(Student::class, 'student_id', 'user_id');
    }

    public function studentUserProfile()
    {
        return $this->belongsTo(User::class, 'student_id', 'id');
    }

    public function supporter()
    {
        return $this->belongsTo(User::class, 'supporter_id', 'id');
    }

    public function classTimes()
    {
        return $this->hasMany(ClassTime::class, 'classroom_id', 'id');
    }

    public function getLastClassTimeAttribute()
    {
        return $this->classTimes()->orderBy('start_at', 'desc')->take(1)->first();
    }

    public function getClassTimesOfLastMonthAttribute()
    {
        $lastClassTime = $this->lastClassTime;
        if (empty($lastClassTime)) return collect([]);

        $time = strtotime($lastClassTime->start_at);
        return $this->getClassTimesOfMonth(date('Y', $time), date('m', $time));
    }

    public function scopeOpening($query)
    {
        return $query->where('status', self::STATUS_OPENING);
    }

    public function scopeClosed($query)
    {
        return $query->where('status', self::STATUS_CLOSED);
    }

    public function getClassTimesOfMonth($year, $month)
    {
        return $this->classTimes()
            ->orderBy('start_at', 'desc')
            ->whereYear('start_at', $year)
            ->whereMonth('start_at', $month)
            ->get();
    }

    public function getCountClassTimesOfMonth($year, $month)
    {
        return $this->classTimes()
            ->whereYear('start_at', $year)
            ->whereMonth('start_at', $month)
            ->count();
    }

    public function getCountTillClassTimesOfMonth($year, $month)
    {
        return $this->classTimes()
            ->whereYear('start_at', '<=', $year)
            ->whereMonth('start_at', '<=', $month)
            ->count();
    }
}
