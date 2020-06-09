# BiMiR

BiMiR is a bicluster database that provides the condition-specific microRNA target predictions. Because miRNAs repress the gene expression post-transcriptionally, mRNA-miRNA paired profilings have been commonly used to predict the condition-specific miRNA targets. However, it is costly, and hence, there are not many publicly available mRNA-miRNA paired profilings for various cell conditions. In this study, we solved these problems by utilizing a large collection of public mRNA microarray data. Using the data, we created a matrix of fold change (FC) values for 20,639 human genes in 5,158 cell conditions (test vs. control group). By biclustering this matrix, we derived 29,815 biclusters for 451 microRNAs. To create these biclusters, first we extracted the initial seed biclusters full of signals (e.g., FC>1.3), and progressively extended them using PBE algorithm including a small number of noises. This process resulted in large and quite dense biclusters compared to those generated by other existing methods. Using the biclusters users can easily navigate the condition-specific miRNA targets and identify new experimental targets.

# Citation

If BiMiR helps your researches, please let the others know! You can cite us as:
**SYoon, HCTNguyen, WJo, JKim, SChi, JPark, SKim, DNam. Biclustering analysis of transcriptome big data identifies condition-specific microRNA targets. Nucleic Acids Research, 2019.DOI:https://doi.org/10.1093/nar/gkz139**

# Contact information
Dr. Dougu Nam - dougnam@unist.ac.kr or
Dr. Hai Nguyen - hainct@unist.ac.kr

# Website: 
**http://btool.org/bimir_dir**
