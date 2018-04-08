Retail<-read.csv("C:/Users/Pratik Karia/Desktop/Apriori/Online Retail.csv")
first<-Retail[1,1]
first<-as.integer(as.character(first))
c=1;
k=1;
datalist<-c();
x<-list()
for(i in 1:100)
{
num<-Retail[i,1];
num<-as.numeric(as.character(num));
if(num==first)
{item<-as.character(Retail[i,3]);
datalist[c]=item;
c=c+1;
}

else
{x[[k]]<-datalist;

datalist<-c();
k<-k+1;
c=1;
first<-first+1;
item<-as.character(Retail[i,3]);
print(item);
datalist[c]=item;
c<-c+1;
}
}
x[[k]]<-datalist
for ( i in x )
{
  str= paste(i, collapse = ', ')
  write(str,file="parsed.txt",append=TRUE, sep = "\n")
}
lapply(x, function(x) write.table(data.frame(x) , 'test.csv'  , append= T, sep=',' ))
