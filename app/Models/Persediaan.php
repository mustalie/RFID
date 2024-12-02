<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Persediaan extends Model
{   
    use HasFactory;
    protected $primaryKey = 'ACC';
    protected $table = 'MPersediaan';
    public $incrementing = false;
    protected $keyType = 'string';

    //protected $keyType = 'string';

    public function stock()
    {
        return $this->hasOne(Stock::class, 'ACC', 'ACC');
    }

    public function group()
    {
        return $this->hasOne(InventoryGroup::class, 'ACC', 'ACC');
    }

    /*
    ACC                                                                                                                              NO          varchar                                                                                                                         
ACG                                                                                                                              YES         varchar                                                                                                                         
AKP                                                                                                                              YES         varchar                                                                                                                         
ACP                                                                                                                              YES         varchar                                                                                                                         
BARC                                                                                                                             NO          varchar                                                                                                                         
BARC2                                                                                                                            YES         varchar                                                                                                                         
BARC3                                                                                                                            YES         varchar                                                                                                                         
BARC4                                                                                                                            YES         varchar                                                                                                                         
GOL                                                                                                                              YES         varchar                                                                                                                         
LVL                                                                                                                              YES         int                                                                                                                             
JEN                                                                                                                              YES         char                                                                                                                            
NAM                                                                                                                              YES         varchar                                                                                                                         
KETER                                                                                                                            NO          varchar                                                                                                                         
UKR                                                                                                                              YES         varchar                                                                                                                         
WRN                                                                                                                              YES         varchar                                                                                                                         
JNS                                                                                                                              YES         varchar                                                                                                                         
SAT                                                                                                                              YES         varchar                                                                                                                         
ST2                                                                                                                              YES         varchar                                                                                                                         
ST3                                                                                                                              YES         varchar                                                                                                                         
KNV                                                                                                                              YES         float                                                                                                                           
KNV2                                                                                                                             YES         int                                                                                                                             
MR1                                                                                                                              YES         varchar                                                                                                                         
MR2                                                                                                                              YES         varchar                                                                                                                         
HB                                                                                                                               YES         float                                                                                                                           
HBA                                                                                                                              YES         float                                                                                                                           
HB2                                                                                                                              YES         float                                                                                                                           
HR                                                                                                                               YES         float                                                                                                                           
HR3                                                                                                                              YES         float                                                                                                                           
HGJ                                                                                                                              YES         float                                                                                                                           
HGJ2                                                                                                                             YES         float                                                                                                                           
HGJ3                                                                                                                             YES         float                                                                                                                           
HGJ4                                                                                                                             YES         float                                                                                                                           
HGCR                                                                                                                             YES         int                                                                                                                             
HGCR2                                                                                                                            YES         int                                                                                                                             
HGCR3                                                                                                                            YES         int                                                                                                                             
HGCR4                                                                                                                            YES         int                                                                                                                             
HKR                                                                                                                              YES         float                                                                                                                           
HKR2                                                                                                                             YES         float                                                                                                                           
DSC1                                                                                                                             YES         float                                                                                                                           
DSC2                                                                                                                             YES         float                                                                                                                           
PJ                                                                                                                               YES         float                                                                                                                           
LB                                                                                                                               YES         float                                                                                                                           
TG                                                                                                                               YES         float                                                                                                                           
BRT                                                                                                                              YES         float                                                                                                                           
MIN                                                                                                                              YES         float                                                                                                                           
MAX                                                                                                                              YES         float                                                                                                                           
HRT                                                                                                                              YES         float                                                                                                                           
HR2                                                                                                                              YES         float                                                                                                                           
QTB                                                                                                                              YES         float                                                                                                                           
QTM                                                                                                                              YES         float                                                                                                                           
QTA                                                                                                                              YES         float                                                                                                                           
QTP                                                                                                                              YES         float                                                                                                                           
QTI                                                                                                                              YES         float                                                                                                                           
QTD                                                                                                                              YES         float                                                                                                                           
QTO                                                                                                                              YES         float                                                                                                                           
QTK                                                                                                                              YES         float                                                                                                                           
RPP                                                                                                                              YES         float                                                                                                                           
RPD                                                                                                                              YES         float                                                                                                                           
RPK                                                                                                                              YES         float                                                                                                                           
RPS                                                                                                                              YES         float                                                                                                                           
AC2                                                                                                                              YES         nvarchar                                                                                                                        
AGL                                                                                                                              YES         nvarchar                                                                                                                        
ASA                                                                                                                              YES         nvarchar                                                                                                                        
AHP                                                                                                                              YES         nvarchar                                                                                                                        
ADI                                                                                                                              YES         nvarchar                                                                                                                        
ANG                                                                                                                              YES         float                                                                                                                           
REA                                                                                                                              YES         float                                                                                                                           
ALK                                                                                                                              YES         varchar                                                                                                                         
AJK                                                                                                                              YES         char                                                                                                                            
FLN                                                                                                                              YES         nvarchar                                                                                                                        
FLG                                                                                                                              YES         char                                                                                                                            
STS                                                                                                                              YES         char                                                                                                                            
FKN                                                                                                                              YES         char                                                                                                                            
Note                                                                                                                             YES         varchar                                                                                                                         
LastModifiedby                                                                                                                   YES         varchar                                                                                                                         
LastModifiedDate                                                                                                                 YES         datetime                                                                        
*/
}
