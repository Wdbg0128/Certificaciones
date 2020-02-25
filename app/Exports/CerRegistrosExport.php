<?php

namespace App\Exports;
use DB;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CerRegistrosExport implements FromCollection,WithHeadings,ShouldAutoSize,WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings(): array
    {
        return[
            'Num_Sap',
            'Apellidos y Nombres',
            'Cedula',
            'Gerencia',
            'Planta',
            'Cargo',
            'Fecha 1er Alta',
            'Fecha Fin del contrato',
            'Tipo de certificación',
            'Nombre Certificado',
            'Nivel',
            'Ente Cetificador',
            'Fecha de Expedición',
            'Fecha de Vencimiento',
            'Concepto de aptitud',
            'Fecha exp concepto',
            'Fecha fin Concepto',
        ];
    }

     public function registerEvents():array
     {
         return[
             AfterSheet::class=>function(AfterSheet $event) {
                 $cellRange='A1:Q1';
                 $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(14);
             }
         ];
     }
     public function collection()
    {
        $FilaDeDatos= DB::table('cer_registros')
                            ->join('datos_personales','cer_registros.Num_Sap','=','datos_personales.Num_Sap','left outer')
                            ->join('mae_tipo_cer','cer_registros.tipo_id','=','mae_tipo_cer.id','left outer')
                            ->join('mae_certificados','cer_registros.maecertificado_id','=','mae_certificados.id','left outer')
                            ->join('mae_nivel_cer','cer_registros.nivel_id','=','mae_nivel_cer.id','left outer')
                            ->join('mae_ente_certificadors','cer_registros.maeentecertificador_id','=','mae_ente_certificadors.id','left outer')
                            ->select('cer_registros.Num_Sap','datos_personales.Apellidos_Nombres','Identificacion',
                                     'Gerencia','Planta','Cargo','fecha_inicio','Fin_Contrato','nombre_tipo_cer','Nombre_Certificado','nombre_nivel_cer','Nombre_EnteCertificador','fecha_Expedicion',
                                     'fecha_Fin','cer_registros.concepto_aptitud','fecha_exp_concepto','fecha_fin_concepto')->get();
           foreach ($FilaDeDatos as $FilaDeDato) {
                if($FilaDeDato->concepto_aptitud==1){
                    $FilaDeDato->concepto_aptitud= "Apto";
                } else{
                    $FilaDeDato->concepto_aptitud="No Apto";
                }
            }
        return $FilaDeDatos;
    }
}
