<?php

class DbaFrtMessage {

    public static $table = "message";

    public function getMessage($id) {
        $db = new medoo();


        $where = array(
            "AND" => array(
                "id" => $id
            ),
            "LIMIT" => 1
        );

        $messageList = $db->select(
                self::$table, '*', $where
        );


        if ($messageList) {
            $message = current($messageList);
            $oDataMessage = new DataMessage();
            $oDataMessage->loadFromArray($message);
            return $oDataMessage;
        } else {
            return null;
        }
    }

    public function getMessagesByRight($rightId) {
        $db = new medoo();

        $return = array();

        $where = array(
            "AND" => array(
                "right_id" => $rightId
            )
        );

        $messages = $db->select(self::$table, array(
            "id",
            "right_id",
            "message",
            "inBox",
            "mailBoxId",
            "parent_message_id",
            "email",
            "status"), $where
        );


        foreach ($messages as $message) {
            $oMessage = new DataMessage();
            $oMessage->loadFromArray($message);
            $return[] = $oMessage;
        }


        return $return;
    }

    public function createMessage(DataMessage $oMessage) {
        $db = new medoo();

        $data = array(
            "right_id" => $oMessage->getRightId(),
            "message" => $oMessage->getMessage(),
            "inBox" => $oMessage->getInBox(),
            "status" => $oMessage->getStatus(),
            "name" => $oMessage->getName(),
            "age" => $oMessage->getAge(),
            "location" => $oMessage->getLocation(),
            "institution_id" => $oMessage->getInstitutionId(),
            "grade" => $oMessage->getGrade(),
            "email" => $oMessage->getEmail(),
            "parent_message_id" => $oMessage->getParentMessageId(),
            "created" => date("Y-m-d H:i:s")
        );

        return $db->insert(self::$table, $data);
    }

//    public function editMessage(DataMessage $oMessage) {
//        $db = new medoo();
//        $data = array(//values
//            "name" => $oMessage->getName(),
//            "page" => $oMessage->getPage(),
//            "description" => $oMessage->getDescription(),
//            "email" => $oMessage->getEmail(),
//            "image" => $oMessage->getImage()
//        );
//
//
//        return $db->update(self::$table, $data, array(//where
//                    "id" => $oMessage->getId()
//        ));
//    }


    public function checkMsgExistByMailBoxId($mailBoxId) {
        $db = new medoo();

        $where = array(
            "AND" => array(
                "mailBoxId" => $mailBoxId
            ),
            "LIMIT" => 1
        );

        $messages = $db->select(
                self::$table, array("id"), $where
        );

        if ($messages) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteMessage($userId) {
        $db = new medoo();

        $where = array(
            "AND" => array(
                "id" => $userId
            ),
        );

        return $db->delete(self::$table, $where);
    }

    public function getMessagesByRightCategory($rightCategory) {

        $join = array(
            '[><]' . DbaFrtRight::$tableRelCategory => array(
                'right_id' => 'id_right'
            )
        );

        $where = array(
            "AND" => array(
                "id_category" => $rightCategory
            ),
            "GROUP" => 'id',
            "ORDER" => "created ASC"
        );

        $db = new medoo();
        $messagesArr = $db->select(self::$table, $join, '*', $where);

        $return = array();

        if ($messagesArr) {
            foreach ($messagesArr as $message) {
                $oDataMessage = new DataMessage();
                $oDataMessage->loadFromArray($message);
                $return[] = $oDataMessage;
            }
        }

        return $return;
    }

}
