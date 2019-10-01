function validarruc()
{
    var acumulado = 0;
    var instancia;
    var ruc = document.getElementById("numero_identidad").value;
    debugger;
    for(i = 0 ;i<ruc.length; i++)
    {
        z = ruc.substring(i,i+1);
        if((z!="0") && (z!="1") && (z!="2") && (z!="3") && (z!="4") && (z!="5") && (z!="6") && (z!="7") && (z!="8") && (z!="9"))
        {
            swal("Upss","Formato de RUC no es  inválido.", "error");
            return;
        }
    }
    if(ruc.length!=13)
    {
        swal("Upss","Formato de RUC no es  inválido.", "error");
        return;
    }
    if((ruc.substring(0,2)>22) || (ruc.substring(0,2)<1))
    {
        swal("Upss","Formato de RUC no es  inválido.", "error");
        return;
    }
    if(ruc.substring(2,3)>=6)
    {
        swal("Upss","Formato de RUC no es  inválido.", "error");
        return;
    } 

    for(i=1; i<=9; i++)
    {
        if (i%2!=0)
        {
            instancia=ruc.substring(i-1,i)*2;
            if(instancia>9) instancia-=9;
        }
        else instancia=ruc.substring(i-1,i);
        acumulado+=parseInt(instancia);
    }
    while (acumulado>0)
    acumulado-=10;

    if(ruc.substring(9,10)!=(acumulado*-1))
    {
        swal("Upss","Formato de RUC no es  inválido.", "error");
        return;
    }

    if((ruc.substring(10,13)!=001) && (ruc.substring(10,13)!=002) && (ruc.substring(10,13)!=003) && (ruc.substring(10,13)!=004) && (ruc.substring(10,13)!=005) && (ruc.substring(10,13)!=006) && (ruc.substring(10,13)!=007) && (ruc.substring(10,13)!=008) && (ruc.substring(10,13)!=009))
    {
        swal("Upss","Formato de RUC no es  inválido.", "error");
        return;
    }
    return true;
}
