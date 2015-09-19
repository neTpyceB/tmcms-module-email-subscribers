<?php

namespace neTpyceB\TMCms\Modules\EmailSubscribers;

use neTpyceB\TMCms\HTML\BreadCrumbs;
use neTpyceB\TMCms\HTML\Cms\CmsTable;
use neTpyceB\TMCms\HTML\Cms\Column\ColumnActive;
use neTpyceB\TMCms\HTML\Cms\Column\ColumnData;
use neTpyceB\TMCms\HTML\Cms\Column\ColumnDelete;
use neTpyceB\TMCms\HTML\Cms\Column\ColumnEdit;
use neTpyceB\TMCms\Modules\EmailSubscribers\Entity\EmailSubscriberEntityRepository;
use neTpyceB\TMCms\Strings\Converter;

defined('INC') or exit;

/**
 * Class CmsEmailSubscribers
 * @package neTpyceB\TMCms\Modules\EmailSubscribers
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
                ->dataType('ts2datetime')
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
}