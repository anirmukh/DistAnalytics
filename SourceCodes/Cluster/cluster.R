setwd("C://xampp/htdocs//API//PAGES//Cluster")
cluster = read.csv("C:/xampp/htdocs/API/PAGES/Cluster/file_cluster.csv")
wr=data.frame(cluster$DISTRIBUTOR_CODE,cluster$REGION,cluster$ITEM_HEAD,cluster$ACT,cluster$SSO)
write.csv(wr,"down.csv");
cluster.features = cluster
cluster.features$REGION <-NULL
cluster.features$ITEM_HEAD <-NULL
cluster.features$DISTRIBUTOR_CODE<-NULL
result <- kmeans(cluster.features,3)
table(cluster$DISTRIBUTOR_CODE,result$cluster)
png(filename="cluster.png")
plot(cluster$ACT,cluster$SSO, xlab='Activation', ylab='Sales', main=' Analysis on Sales by DTRs' ,pch=20, col=result$cluster)
dev.off()
file.remove("file_cluster.csv")
