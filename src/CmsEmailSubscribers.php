<?php

namespace TMCms\AdminTMCms\Modules\EmailSubscribers;

use TMCms\AdminTMCms\Admin\Messages;
use TMCms\AdminTMCms\HTML\BreadCrumbs;
use TMCms\AdminTMCms\HTML\Cms\CmsFormHelper;
use TMCms\AdminTMCms\HTML\Cms\CmsTable;
use TMCms\AdminTMCms\HTML\Cms\Column\ColumnActive;
use TMCms\AdminTMCms\HTML\Cms\Column\ColumnData;
use TMCms\AdminTMCms\HTML\Cms\Column\ColumnDelete;
use TMCms\AdminTMCms\HTML\Cms\Column\ColumnEdit;
use TMCms\AdminTMCms\Log\App;
use TMCms\AdminTMCms\Modules\EmailSubscribers\Entity\EmailSubscriberEntity;
use TMCms\AdminTMCms\Modules\EmailSubscribers\Entity\EmailSubscriberEntityRepository;
use TMCms\AdminTMCms\Strings\Converter;

defined('INC') or exit;

/**
 * Class CmsEmailSubscribers
 * @package TMCms\AdminTMCms\Modules\EmailSubscribers
 */
class CmsEmailSubscribers
{

    public function _default()
    {
        $breadcrumbs = BreadCrumbs::getInstance()
            ->addCrumb(Converter::symb2Ttl(P))
            ->addCrumb('All')
        ;

        $data = new EmailSubscriberEntityRepository;

        $table = CmsTable::getInstance()
            ->addData($data)
            ->addColumn(ColumnData::getInstance('email')
                ->dataType('email')
                ->enableOrderableColumn()
            )
            ->addColumn(ColumnData::getInstance('ts')
                ->title('Date')
                ->dataType('ts2date')
                ->enableOrderableColumn()
            )
            ->addColumn(ColumnEdit::getInstance('edit')
                ->href('?p=' . P . '&do=edit&id={%id%}')
                ->width('1%')
                ->value('Edit')
            )
            ->addColumn(ColumnActive::getInstance('active')
                ->href('?p=' . P . '&do=_active&id={%id%}')
                ->enableOrderableColumn()
                ->ajax(true)
            )
            ->addColumn(ColumnDelete::getInstance('delete')
                ->href('?p=' . P . '&do=_delete&id={%id%}')
            )
        ;

        echo $breadcrumbs;
        echo $table;
    }

    public function __subscribers_form($data = NULL)
    {
        $form_array = [
            'data' => $data,
            'button' => 'Update',
            'combine' => true,
            'fields' => [
                'ts' => [
                    'name' => 'Date',
                    'type' => 'datetime'
                ],
                'receive_news' => [
                    'type' => 'checkbox'
                ],
                'receive_ads' => [
                    'type' => 'checkbox'
                ]
            ],
            'unset' => [
                'id',
                'user_id'
            ]
        ];

        return CmsFormHelper::outputForm(ModuleEmailSubscribers::$tables['subscribers'],
            $form_array
        );
    }

    public function edit()
    {
        $id = abs((int)$_GET['id']);
        if (!$id) return;

        $subscriber = new EmailSubscriberEntity($id);;

        echo BreadCrumbs::getInstance()
            ->addCrumb(Converter::symb2Ttl(P), '?p='. P)
            ->addCrumb('Edit Email Subscriber')
            ->addCrumb($subscriber->getEmail())
        ;

        echo self::__subscribers_form($subscriber)
            ->setAction('?p='. P .'&do=_edit&id='. $id)
        ;
    }

    public function _edit()
    {
        $id = abs((int)$_GET['id']);
        if (!$id) return;

        // Convert data to ts
        $_POST['ts'] = strtotime($_POST['ts']);

        $subscriber = new EmailSubscriberEntity($id);
        $subscriber->loadDataFromArray($_POST);
        $subscriber->save();

        App::add('Email Subscriber with email  "' . $subscriber->getEmail() . '" updated');

        Messages::sendMessage('Subscriber updated');

        go('?p='. P .'&highlight='. $subscriber->getId());
    }

    public function _active()
    {
        $id = abs((int)$_GET['id']);
        if (!$id) return;

        $subscriber = new EmailSubscriberEntity($id);
        $subscriber->flipBoolValue('active');
        $subscriber->save();

        App::add('Email Subscriber with email  "' . $subscriber->getEmail() . '" '. ($subscriber->getActive() ? '' : 'de') .'activated');

        Messages::sendMessage('Subscriber '. ($subscriber->getActive() ? '' : 'de') .'activated');

        if (IS_AJAX_REQUEST) {
            die('1');
        }
        back();
    }

    public function _delete()
    {
        $id = abs((int)$_GET['id']);
        if (!$id) return;

        $subscriber = new EmailSubscriberEntity($id);
        $subscriber->deleteObject();

        App::add('Email Subscriber with email  "' . $subscriber->getEmail() . '" deleted');

        Messages::sendMessage('Subscriber deleted');

        back();
    }
}