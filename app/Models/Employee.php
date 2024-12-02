<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $primaryKey = 'EmployeeNo';
    protected $table = 'EmployeeMaster';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $hidden = [
        'TimeStamp',
        'LastModifiedBy',
        'LastModifiedDate'
    ];

    public function dosen()
    {
        return $this->hasOne(Dosen::class, 'NID', 'EmployeeNo');
    }

    /*
    EmployeeNo                                                                                                                       NO          varchar                                                                                                                         
Title                                                                                                                            YES         varchar                                                                                                                         
FullName                                                                                                                         NO          varchar                                                                                                                         
FamilyName                                                                                                                       YES         varchar                                                                                                                         
NickName                                                                                                                         YES         varchar                                                                                                                         
JoinDate                                                                                                                         YES         date                                                                                                                            
BirthPlace                                                                                                                       YES         varchar                                                                                                                         
BirthDate                                                                                                                        YES         datetime                                                                                                                        
Gender                                                                                                                           YES         varchar                                                                                                                         
MaritalStatusActual                                                                                                              YES         varchar                                                                                                                         
Tanggungan                                                                                                                       YES         varchar                                                                                                                         
BloodType                                                                                                                        YES         varchar                                                                                                                         
ReligionCode                                                                                                                     YES         varchar                                                                                                                         
NationalityCode                                                                                                                  YES         varchar                                                                                                                         
EKtp                                                                                                                             YES         varchar                                                                                                                         
EPassp                                                                                                                           YES         varchar                                                                                                                         
ESIM                                                                                                                             YES         varchar                                                                                                                         
PersonalMobilePhone                                                                                                              YES         varchar                                                                                                                         
PersonalEmailAddress                                                                                                             YES         varchar                                                                                                                         
CompanyEmailAddress                                                                                                              YES         varchar                                                                                                                         
FlagExpatriate                                                                                                                   YES         bit                                                                                                                             
ExpatriateRegisterNo                                                                                                             YES         varchar                                                                                                                         
ExpatriateRegisterStartDate                                                                                                      YES         datetime                                                                                                                        
ExpatriateRegisterEndDate                                                                                                        YES         datetime                                                                                                                        
CurrentAddress                                                                                                                   YES         varchar                                                                                                                         
City                                                                                                                             YES         varchar                                                                                                                         
Note                                                                                                                             YES         varchar                                                                                                                         
ActiveStatus                                                                                                                     YES         varchar                                                                                                                         
FlagHasPrepared                                                                                                                  YES         bit                                                                                                                             
RaceCode                                                                                                                         YES         varchar                                                                                                                         
GlobalID                                                                                                                         YES         varchar                                                                                                                         
FlagPayroll                                                                                                                      YES         char                                                                                                                            
FlagGrop                                                                                                                         YES         char                                                                                                                            
LastModifiedBy                                                                                                                   NO          varchar                                                                                                                         
LastModifiedDate                                                                                                                 NO          datetime                                                                                                                        
TimeStamp         
    */
}
