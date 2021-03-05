#!/usr/bin/env bash

set -e

DIRECTORY=$(cd `dirname $0` && pwd)
# DIST=$DIRECTORY/../dist
RESOURCES=$DIRECTORY/../resources/svg

SOURCE=$1
echo $SOURCE
echo "Reading categories..."
for CATEGORY_DIR in $SOURCE/src/*; do
    # Category Directory Path
    # echo $CATEGORY_DIR

    # Category Name
    CATEGORY_NAME=${CATEGORY_DIR##*/}
    # echo $CATEGORY_NAME
    # exit
    for ICON_DIR in $CATEGORY_DIR/*; do
        # Icon Directory Path
        # echo $ICON_DIR
        ICON_NAME=${ICON_DIR##*/}
        # echo $ICON_NAME
        # exit
        for ICON_TYPE_DIR in $ICON_DIR/*; do
            # Icon Type Directory Path
            # echo $ICON_TYPE_DIR


            # eg: materialicons, materialiconsoutlined, materialiconsround, materialiconssharp, materialiconstwotone
            ICON_TYPE_NAME=${ICON_TYPE_DIR##*/}
            # echo $ICON_TYPE_NAME
            # exit

            ICON_SRC=$ICON_TYPE_DIR'/24px.svg'
            ICON_DESTINATION_NAME=${ICON_DIR##*/}
            # echo $ICON_DESTINATION_NAME
            CONVERTED_ICON_DESTINATION_NAME="${ICON_DESTINATION_NAME//_/-}"
            # echo $CONVERTED_ICON_DESTINATION_NAME
            # exit
            if [[ $ICON_TYPE_NAME = 'materialicons' ]]
            then
                CP_COMMAND='cp '$ICON_SRC' '$RESOURCES/$CONVERTED_ICON_DESTINATION_NAME'.svg'
                $CP_COMMAND
            elif [[ $ICON_TYPE_NAME = 'materialiconsoutlined' ]]
            then
                CP_COMMAND='cp '$ICON_SRC' '$RESOURCES'/o-'$CONVERTED_ICON_DESTINATION_NAME'.svg'
                $CP_COMMAND
            elif [[ $ICON_TYPE_NAME = 'materialiconsround' ]]
            then
                CP_COMMAND='cp '$ICON_SRC' '$RESOURCES'/r-'$CONVERTED_ICON_DESTINATION_NAME'.svg'
                $CP_COMMAND
            elif [[ $ICON_TYPE_NAME = 'materialiconssharp' ]]
            then
                CP_COMMAND='cp '$ICON_SRC' '$RESOURCES'/s-'$CONVERTED_ICON_DESTINATION_NAME'.svg'
                $CP_COMMAND
            elif [[ $ICON_TYPE_NAME = 'materialiconstwotone' ]]
            then
                CP_COMMAND='cp '$ICON_SRC' '$RESOURCES'/tt-'$CONVERTED_ICON_DESTINATION_NAME'.svg'
                $CP_COMMAND
            fi
        done
    done
done


# echo "Compiling outline icons..."

# for FILE in $DIST/outline/*; do
#   cp $FILE $RESOURCES/o-$(echo ${FILE##*/})
# done

# echo "Compiling solid icons..."

# for FILE in $DIST/solid/*; do
#   cp $FILE $RESOURCES/s-$(echo ${FILE##*/})
# done

# echo "All done!"
