package it.hackerinside.hackerinsidenotes;

public class Nota {
    public String ID;
    public String titolo;
    public String nota;
    public String dataSalvataggio;

    public Nota(){

    }

    public Nota(String ID,String titolo,String nota,String dataSalvataggio){
        this.ID = ID;
        this.titolo = titolo;
        this.nota = nota;
        this.dataSalvataggio = dataSalvataggio;
    }
    public String toString() {
        return titolo;
    }
}
