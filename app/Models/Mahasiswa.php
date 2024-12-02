<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;
    protected $primaryKey = 'NIM';
    protected $table = 'MHSMaster';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $casts = [
        'NIM' => 'string',
    ];
    
    protected $hidden = [
        'TimeStamp',
        'LastModifiedBy',
        'LastModifiedDate'
    ];

    /*
    NIM                                                                                                                              NO          varchar                                                                                                                         
AbsenteeismNo                                                                                                                    YES         varchar                                                                                                                         
FullName                                                                                                                         NO          varchar                                                                                                                         
FamilyName                                                                                                                       YES         varchar                                                                                                                         
NickName                                                                                                                         YES         varchar                                                                                                                         
BirthPlace                                                                                                                       YES         varchar                                                                                                                         
BirthDate                                                                                                                        YES         datetime                                                                                                                        
Gender                                                                                                                           YES         varchar                                                                                                                         
MaritalStatusActual                                                                                                              YES         varchar                                                                                                                         
BloodType                                                                                                                        YES         varchar                                                                                                                         
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
Note                                                                                                                             YES         varchar                                                                                                                         
LastModifiedBy                                                                                                                   NO          varchar                                                                                                                         
LastModifiedDate                                                                                                                 NO          datetime                                                                                                                        
TimeStamp  
*/
}
