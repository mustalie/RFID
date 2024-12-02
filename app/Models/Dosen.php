<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    use HasFactory;
    protected $primaryKey = 'NID';
    protected $table = 'EmpDosen';
    public $incrementing = false;
    protected $keyType = 'string';

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'EmployeeNo', 'NID');
    }

    protected $casts = [
        'NID' => 'string',
    ];

    protected $hidden = [
        'TimeStamp',
        'LastModifiedBy',
        'LastModifiedDate'
    ];
    
    /*
    NID                                                                                                                              NO          varchar                                                                                                                         
NIDN                                                                                                                             YES         varchar                                                                                                                         
AbsenteeismNo                                                                                                                    YES         varchar                                                                                                                         
FullName                                                                                                                         NO          varchar                                                                                                                         
FamilyName                                                                                                                       YES         varchar                                                                                                                         
NickName                                                                                                                         YES         varchar                                                                                                                         
Address                                                                                                                          YES         varchar                                                                                                                         
City                                                                                                                             YES         varchar                                                                                                                         
PosCode                                                                                                                          YES         varchar                                                                                                                         
BirthPlace                                                                                                                       YES         varchar                                                                                                                         
BirthDate                                                                                                                        YES         datetime                                                                                                                        
Gender                                                                                                                           YES         varchar                                                                                                                         
EKTP                                                                                                                             YES         varchar                                                                                                                         
Gelar                                                                                                                            YES         varchar                                                                                                                         
Gelar2                                                                                                                           YES         varchar                                                                                                                         
IPK                                                                                                                              YES         decimal                                                                                                                         
SexCode                                                                                                                          YES         varchar                                                                                                                         
KTP                                                                                                                              YES         varchar                                                                                                                         
TAXNO                                                                                                                            YES         varchar                                                                                                                         
MaritalStatus                                                                                                                    YES         varchar                                                                                                                         
BloodType                                                                                                                        YES         varchar                                                                                                                         
PendidikanAkhir                                                                                                                  YES         varchar                                                                                                                         
ReligionCode                                                                                                                     YES         varchar                                                                                                                         
NationalityCode                                                                                                                  YES         varchar                                                                                                                         
PersonalMobilePhone                                                                                                              YES         varchar                                                                                                                         
PersonalEmailAddress                                                                                                             YES         varchar                                                                                                                         
CompanyEmailAddress                                                                                                              YES         varchar                                                                                                                         
FlagExpatriate                                                                                                                   YES         bit                                                                                                                             
ExpatriateRegisterNo                                                                                                             YES         varchar                                                                                                                         
ExpatriateRegisterStartDate                                                                                                      YES         datetime                                                                                                                        
ExpatriateRegisterEndDate                                                                                                        YES         datetime                                                                                                                        
RaceCode                                                                                                                         YES         varchar                                                                                                                         
GlobalID                                                                                                                         YES         varchar                                                                                                                         
Title                                                                                                                            YES         varchar                                                                                                                         
FlagHasPrepared                                                                                                                  YES         bit                                                                                                                             
Progdi                                                                                                                           YES         varchar                                                                                                                         
StatusAwal                                                                                                                       YES         varchar                                                                                                                         
ActiveStatus                                                                                                                     YES         varchar                                                                                                                         
StatusMhs                                                                                                                        YES         nchar                                                                                                                           
Alumni                                                                                                                           YES         varchar                                                                                                                         
Jurusan                                                                                                                          YES         varchar                                                                                                                         
FlagTitle                                                                                                                        YES         varchar                                                                                                                         
JoinDate                                                                                                                         YES         date                                                                                                                            
Note                                                                                                                             YES         varchar                                                                                                                         
LastModifiedBy                                                                                                                   NO          varchar                                                                                                                         
LastModifiedDate                                                                                                                 NO          datetime                                                                                                                        
TimeStamp                 
     */
}
