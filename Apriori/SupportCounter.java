//package apriori;

import java.io.File;
import java.io.FileWriter;
import java.io.IOException;
import java.util.ArrayList;
import java.util.Collections;
import java.util.HashMap;
import java.util.Scanner;

public class SupportCounter{
    static long startTime = System.nanoTime();
    static int callcount = 0;
    static int itemsize=0;
    public static void SupCoun()
    {
    //  HashMap map = new HashMap(); 
    //  String dataset = "dataset.txt";//determines name of file
        try {
            callcount = callcount +1;

            if(callcount ==1){

                HashMap map = new HashMap(); 
            String dataset = "parsed.txt";//determines name of file
        //  callcount = callcount +1;
            FileWriter Lk = new FileWriter("L"+callcount+".txt");
            Scanner list = new Scanner(new File(dataset));


            while (list.hasNext()) {

                String word = list.next();
                if (!list.hasNext()){
                    Lk.write("Time of Execution : "+ gettime()+" nano seconds"+System.getProperty("line.separator" ));
                }
                if(map.containsKey(word)) {
                    //itemsize=1;
                  Integer count = (Integer)map.get(word);
                  map.put(word, new Integer(count.intValue() + 1));
                } else {
                   map.put(word, new Integer(1));
                }
              }
            ArrayList arraylist = new ArrayList(map.keySet());
            Collections.sort(arraylist);
            for (int i = 0; i < arraylist.size(); i++) {
              String key = (String)arraylist.get(i);
              Integer count = (Integer)map.get(key);
            if( count >= Main.minSup)
                    {
                    Lk.write(key + " : " + count + System.getProperty( "line.separator" ));
                    }
                }      
            list.close();
            Lk.close();
            }//call count = 1 if end

            else if(callcount > 1){ // Write Lk
                countfre(callcount);

            }//else-if end
        } // Try END

        catch (IOException e) 
        {
            e.printStackTrace();
        }
    }//SupCoun END

private static void countfre(int filenumber) throws IOException{

        ArrayList<String> ckwords = new ArrayList<String>();
        ArrayList<String> dbwords = new ArrayList<String>();
        FileWriter Lk = new FileWriter("L"+filenumber+".txt");
        File ck = new File("C"+filenumber+".txt");
        Scanner ckscan = new Scanner(ck);//.useDelimiter(":");

         File dataset = new File("Dataset.txt");
         Scanner dbscan = new Scanner(dataset).useDelimiter("\n");

         int j1,i1 =0;
         if(ckscan.hasNext())
         {
         ckscan.nextLine();
         }
         Lk.write("Time of Execution : "+ gettime()+" nano seconds"+System.getProperty("line.separator" ));
         while(dbscan.hasNext())
         {

             String wrd = dbscan.nextLine();
             dbwords.add(wrd);
         }
         while(ckscan.hasNext())
         {
             String wrd2 = ckscan.nextLine();
             ckwords.add(wrd2);
         }
         int counter =0;
         ckscan = new Scanner(ck);//.useDelimiter(":");
         if(ckscan.hasNext())
         ckscan.nextLine();
         while(ckscan.hasNext())
         {
             dbscan = new Scanner(dataset).useDelimiter("\n");
             String wrd2 = ckscan.nextLine();
             ckwords.add(wrd2);

             for(j1=0;j1<dbwords.size();j1++){
                 if(dbwords.get(j1).contains(wrd2)){
                     counter++;
                 }
             }

             if(counter >= Main.minSup){

             Lk.write(wrd2+" : "+counter+ System.getProperty( "line.separator" ));
             }
            // System.out.println(wrd2+"--"+counter);
       // System.out.println("--------------------------------------------------------------");
         }
         Lk.close();         
      }




//////////////END TIMER
public static long gettime()
    {
        long endTime   = System.nanoTime();
        long totalTime = (long) ((endTime - startTime));
        return(totalTime);
    }
}