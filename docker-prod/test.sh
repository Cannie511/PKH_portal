declare -a ALL_CLIENT_SITES=("thuanhung" "phuochoang")


for client in "${ALL_CLIENT_SITES[@]}"
do
    echo "$client"
    # or do whatever with individual element of the array
done