import java.util.*;
import java.io.*;
@SuppressWarnings("unused")
public class Main {
    public static int minSup = 2;

    public static void main(String args[]) throws IOException {
    FileWriter summary= new FileWriter("Summary.txt");
    String Freqitems = "Frequent.txt";
    String Infreqitems = "Infrequent.txt";
    long startTime = System.nanoTime();
    do{
        CandidateGen.CandGen();
        CandidateGen.CandGen();
        CandidateGen.CandGen();

    }while(SupportCounter.itemsize > 0);

//  WRITING SUMMARY FILE        
        long endTime = System.nanoTime();
        LineNumberReader  Frelnr = new LineNumberReader(new FileReader(Freqitems));
        LineNumberReader  Infrelnr = new LineNumberReader(new FileReader(Infreqitems));
        Frelnr.skip(Long.MAX_VALUE);
        Infrelnr.skip(Long.MAX_VALUE);
        long totalTime = (endTime - startTime);
        summary.write("MinSup = "+minSup+System.getProperty("line.separator" )+
                        "Total T(C): "+CandidateGen.gettime()+" Nano seconds"+System.getProperty("line.separator" )+
                        "Total T(L): "+SupportCounter.gettime()+" Nano seconds"+System.getProperty("line.separator" )+
                        "Total Time of Execution = "+totalTime+" nano seconds"+System.getProperty("line.separator" )+
                        "Frequent itemsets: "+(Frelnr.getLineNumber() - 1)+System.getProperty("line.separator")+
                        "Infrequent itemsets: "+(Infrelnr.getLineNumber() - 1)+System.getProperty("line.separator"));
        summary.close();
        Frelnr.close();
        Infrelnr.close();
    }
}